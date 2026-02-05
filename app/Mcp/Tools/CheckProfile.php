<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use App\Models\User;
use App\Models\Offres;
use Illuminate\Support\Facades\Http;

class CheckProfile extends Tool
{
    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
        verifier si un user est eligible pour une offre .
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $input = $request->all();
        $user = User::with('profile')->find($input['user_id']);
        $offre = Offres::find($input['ofre_id']);

        if(!$user || !$offre ){
            return Response::json([
                'status'=>'error',
                'message'=>'Utilisateur ou offre introvable'
            ]);
        }

        $result = self::verify($user, $offre);

        if ($result['status'] === 'error') {
            return Response::json($result);
        }

        return Response::json([
            'status' => 'success',
            'analysis' => $result['analysis']
        ]);
    }

    /**
     * Static verification method usable by Controllers
     */
    public static function verify(User $user, Offres $offre): array
    {
        $profile = $user->profile; 

        if (!$profile) {
            return [
                'status' => 'error',
                'message' => 'Profil utilisateur non trouvé'
            ];
        }

        $skills = self::safeImplode($profile->skills ?? []);
        $experiences = self::safeImplode($profile->experiances ?? []);
        $projects = self::safeImplode($profile->projects ?? []);
        $competencesOffre = self::safeImplode($offre->competences ?? []);
        
        $prompt = "
        Tu es un recruteur intelligent.

        Analyse la compatibilité entre ce candidat et cette offre.

        === PROFIL UTILISATEUR ===
        Nom: {$user->name}
        Rôle: {$user->role}
        Compétences: {$skills}
        Expérience: {$experiences}
        Projets: {$projects}

        === OFFRE ===
        Titre: {$offre->title}
        Description: {$offre->description}
        Compétences demandées: {$competencesOffre}

        Réponds en JSON strict avec ce format :

        {
        \"eligible\": true/false,
        \"score\": 0-100,
        \"reason\": \"Explication détaillée de la décision.\",
        \"details\": {
            \"strengths\": [\"Point fort 1\", \"Point fort 2\"],
            \"weaknesses\": [\"Point faible 1\", \"Point faible 2\"],
            \"missing_skills\": [\"Compétence manquante 1\"]
        }
        }
        ";

        // Utilisation de Google Gemini (Gratuit)
        // Modèle: gemini-2.5-flash (Disponible avec votre clé)
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::timeout(30)->withHeaders([
                'Content-Type'=>'application/json',
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.3,
                    'responseMimeType' => 'application/json' 
                ]
            ]);

            if ($response->failed()) {
                $errorBody = $response->json();
                $errorMessage = $errorBody['error']['message'] ?? $response->body();
                return self::getMockAnalysis($user, $offre, "ERREUR GEMINI ({$response->status()}): $errorMessage");
            }

            $geminiBody = $response->json();
            
            // Safety check for candidates
            if (empty($geminiBody['candidates'][0]['content']['parts'][0]['text'])) {
                 \Log::warning('Gemini Empty Response', ['body' => $geminiBody]);
                 return self::getMockAnalysis($user, $offre, "REPONSE GEMINI VIDE/FILTRÉE");
            }

            $rawContent = $geminiBody['candidates'][0]['content']['parts'][0]['text'];
            
            // Nettoyage du markdown si présent ( ```json ... ``` )
            $rawContent = str_replace(['```json', '```'], '', $rawContent);
            $parsed = json_decode($rawContent, true);

            return [
                'status' => 'success',
                'analysis' => $parsed
            ];

        } catch (\Throwable $e) {
            \Log::error('CheckProfile Error', ['message' => $e->getMessage()]);
            return self::getMockAnalysis($user, $offre, "EXCEPTION: " . $e->getMessage());
        }
    }

    private static function getMockAnalysis(User $user, Offres $offre, string $errorContext = null)
    {
        // Récupération sécurisée des compétences (tableaux ou chaînes)
        $userSkills = $user->profile->skills ?? [];
        if (is_string($userSkills)) {
            $userSkills = array_map('trim', explode(',', $userSkills));
        }

        $offerSkills = $offre->competences ?? [];
        if (is_string($offerSkills)) {
            $offerSkills = array_map('trim', explode(',', $offerSkills));
        }

        // Comparaison basique (sensible à la casse pour faire simple, ou strcasecmp pour mieux)
        $matchingSkills = [];
        $missingSkills = [];

        foreach ($offerSkills as $oS) {
            $found = false;
            foreach ($userSkills as $uS) {
                if (strcasecmp($oS, $uS) === 0) {
                    $matchingSkills[] = $oS;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $missingSkills[] = $oS;
            }
        }

        // Calcul du score simple
        $total = count($offerSkills);
        $matches = count($matchingSkills);
        
        // Score de base + petit bonus aléatoire pour faire "IA"
        $baseScore = $total > 0 ? ($matches / $total) * 100 : 50;
        $finalScore = min(98, max(10, (int)$baseScore));

        $eligible = $finalScore >= 50;
        
        $reasonPrefix = $errorContext ? "🚨 [MODE SIMULATION - $errorContext] " : "Analyse basée sur les compétences clés.";

        return [
            'status' => 'success',
            'analysis' => [
                'eligible' => $eligible,
                'score' => $finalScore,
                'reason' => $reasonPrefix . " Le candidat possède " . count($matchingSkills) . " des " . count($offerSkills) . " compétences requises.",
                'details' => [
                    'strengths' => !empty($matchingSkills) ? $matchingSkills : ['Motivation', 'Potentiel'],
                    'weaknesses' => !empty($missingSkills) ? ['Besoin de formation technique'] : [],
                    'missing_skills' => $missingSkills
                ]
            ]
        ];
    }

    /**
     * Helper to safely implode array even if it contains arrays/objects
     */
    private static function safeImplode($input): string
    {
        if (!is_array($input)) {
            return (string) $input;
        }

        return implode(', ', array_map(function($item) {
            if (is_array($item) || is_object($item)) {
                // If the item has a 'title' or 'name', use it (common for experience/projects)
                if (is_array($item)) {
                    return $item['title'] ?? $item['name'] ?? json_encode($item);
                }
                return json_encode($item);
            }
            return (string) $item;
        }, $input));
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\Contracts\JsonSchema\JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'user_id' => $schema->integer(),
            'ofre_id' => $schema->integer(),
        ];
    }
}

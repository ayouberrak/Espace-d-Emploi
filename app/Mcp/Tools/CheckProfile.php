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
    protected string $description = <<<'MARKDOWN'
        verifier si un user est eligible pour une offre .
    MARKDOWN;


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

        // gemini-2.5-flash
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
                return [
                    'status' => 'error',
                    'message' => "ERREUR GEMINI ({$response->status()}): $errorMessage"
                ];
            }

            $geminiBody = $response->json();
            
            if (empty($geminiBody['candidates'][0]['content']['parts'][0]['text'])) {
                 \Log::warning('Gemini Empty Response', ['body' => $geminiBody]);
                 return [
                    'status' => 'error',
                    'message' => "REPONSE GEMINI VIDE/FILTRÉE"
                 ];
            }

            $rawContent = $geminiBody['candidates'][0]['content']['parts'][0]['text'];
            
            $rawContent = str_replace(['```json', '```'], '', $rawContent);
            $parsed = json_decode($rawContent, true);

            return [
                'status' => 'success',
                'analysis' => $parsed
            ];

        } catch (\Throwable $e) {
            \Log::error('CheckProfile Error', ['message' => $e->getMessage()]);
            return [
                'status' => 'error',
                'message' => "EXCEPTION: " . $e->getMessage()
            ];
        }
    }




    private static function safeImplode($input): string
    {
        if (!is_array($input)) {
            return (string) $input;
        }

        return implode(', ', array_map(function($item) {
            if (is_array($item) || is_object($item)) {
                if (is_array($item)) {
                    return $item['title'] ?? $item['name'] ?? json_encode($item);
                }
                return json_encode($item);
            }
            return (string) $item;
        }, $input));
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'user_id' => $schema->integer(),
            'ofre_id' => $schema->integer(),
        ];
    }
}

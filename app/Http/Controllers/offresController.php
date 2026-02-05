<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offres;
use App\Models\User;
use App\Models\Recruteur;
use App\Mcp\Tools\CheckProfile;
use App\Models\Application;

use App\Notifications\NouvelleNotification;

class offresController extends Controller
{
    public function offres()
    {
        $offres = Offres::with('applications')->get()->map(function($offre) {
            $jsonCandidats = $offre->candidat ?? [];
            $appCandidats = $offre->applications->pluck('user_id')->toArray();
            
            $uniqueCandidats = array_unique(array_merge($jsonCandidats, $appCandidats));

            return [
                'offre' => [
                    'id' => $offre->id,
                    'title' => $offre->title,
                    'description' => $offre->description,
                    'type' => $offre->ofres_type,   
                    'durre' => $offre->durre,
                    'created_at' => $offre->created_at,
                    'competences' => $offre->competences,
                    'candidats' => $uniqueCandidats,
                ],
                'applicants_count' => count($uniqueCandidats),
                'entrepris' => [
                    'id' => $offre->entreprise->id ,
                    'name' => $offre->entreprise->name ,
                    'location' => $offre->entreprise->location ,
                    'logo' => $offre->entreprise->logo ,
                ]
            ];
        });
        return view('pages.offres', compact('offres'));
    }


    public function offreDetails($id)
    {
        $offre = Offres::with(['entreprise', 'applications' => function($query) {
            $query->orderBy('score', 'desc');
        }, 'applications.user'])->findOrFail($id);

        // Logic for legacy candidates (those in JSON but not in Application table)
        $applicationUserIds = $offre->applications->pluck('user_id')->toArray();
        $legacyIds = $offre->candidat ?? [];
        $missingIds = array_diff($legacyIds, $applicationUserIds);

        $legacyCandidates = [];
        if (!empty($missingIds)) {
            $legacyCandidates = User::whereIn('id', $missingIds)->with('profile')->get(); 
        }

        return view('pages.offreDetails', [
            'offre' => $offre,
            'entreprise' => $offre->entreprise,
            'applications' => $offre->applications,
            'legacyCandidates' => $legacyCandidates
        ]);
    }

    public function postuler($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = User::with('profile')->find(auth()->id());
        if(!$user){
            return back()->with('error', 'Profil utilisateur non trouvé');
        }
        
        $offre = Offres::findOrFail($id);
        
        if (Application::where('user_id', $user->id)->where('ofre_id', $id)->exists()) {
             return back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        // Vérification IA via CheckProfile Tool
        $check = CheckProfile::verify($user, $offre);
        
        \Log::info('Postuler Analysis', ['user' => $user->id, 'offer' => $offre->id, 'check' => $check]);

        $score = 0;
        $analysisData = [];

        if (isset($check['status']) && $check['status'] === 'success') {
            $analysis = $check['analysis'];
            $analysisData = $analysis;
            $score = $analysis['score'] ?? 0;

            if (isset($analysis['eligible']) && !$analysis['eligible']) {
                $reason = $analysis['reason'] ?? 'Profil incompatible.';
                \Log::info('Application Rejected via AI', ['reason' => $reason]);
                
                $missing = '';
                if (!empty($analysis['details']['missing_skills'])) {
                    $missing = ' (Manque: ' . implode(', ', $analysis['details']['missing_skills']) . ')';
                }
                return back()->with('error', 'Candidature refusée par l\'IA : ' . $reason . $missing);
            }
        }

        Application::create([
            'user_id' => $user->id,
            'ofre_id' => $offre->id,
            'score' => $score,
            'status' => 'pending',
            'ai_analysis' => $analysisData
        ]);

        $recruiter = User::find($offre->recruiter_id);
        if ($recruiter) {
            try {
                $candidateName = $user->name;
                $recruiter->notify(new NouvelleNotification("$candidateName a postulé à votre offre : " . $offre->title));
            } catch (\Exception $e) {
                // Log error but continue execution so the application is saved
                \Log::error('Notification failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Votre candidature a été envoyée avec succès ! Score de compatibilité : ' . $score . '%');
    }

    public function ofresByRecruteur()
    {
        if (!auth()->check() || auth()->user()->role !== 'recruiter') {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $recruiter = Recruteur::find($user->id); 
        
        $entreprise = $recruiter->entreprises()->first(); 
        $offres = $recruiter->offres()->with('applications')->get();

        return view('pages.recruiter_offres', compact('recruiter', 'entreprise', 'offres'));
    }
}

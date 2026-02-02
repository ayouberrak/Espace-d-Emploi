<?php

namespace App\Http\Controllers;

use App\Models\Recruteur;
use Illuminate\Http\Request;
use App\Models\Offres;

class RecruiterController extends Controller
{
    public function dashboard()
    {
                $stats = [
            'active_jobs' => 4,
            'total_applicants' => 84,
            'views_this_week' => 1250,
        ];

        $myJobs = [
            [
                'id' => 1,
                'title' => 'Senior React Developer',
                'location' => 'Casablanca (Remote)',
                'created_at' => '2j',
                'applicants_count' => 12,
                'status' => 'Actif'
            ],
            [
                'id' => 2,
                'title' => 'UI/UX Designer',
                'location' => 'Rabat',
                'created_at' => '5j',
                'applicants_count' => 45,
                'status' => 'Expiré'
            ]
        ];

        return view('recruiter.dashboard', compact('stats', 'myJobs'));
    }

    public function createJob()
    {
        return redirect()->route('mesoffres'); 
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ofres_type' => 'required|string',
            'durre' => 'required|string',
            'competences' => 'nullable|string',
        ]);

        $user = auth()->user();
        $recruiter = Recruteur::find($user->id);
        $entreprise = $recruiter->entreprises()->first();

        if (!$entreprise) {
            return back()->with('error', 'Vous devez avoir une entreprise pour publier une offre.');
        }

        $competences = $request->competences ? array_map('trim', explode(',', $request->competences)) : [];

        Offres::create([
            'recruiter_id' => $user->id,
            'enptrise_id' => $entreprise->id, 
            'title' => $request->title,
            'description' => $request->description,
            'ofres_type' => $request->ofres_type,
            'durre' => $request->durre,
            'competences' => $competences,
            'created_at' => now(),
        ]);

        return redirect()->route('mesoffres')->with('success', 'Offre publiée avec succès !');
        return redirect()->route('mesoffres')->with('success', 'Offre publiée avec succès !');
    }

    public function showJob($id)
    {
        $user = auth()->user();
        $offer = Offres::where('id', $id)
                      ->where('recruiter_id', $user->id)
                      ->firstOrFail();
        
        // Fetch candidates manually since 'candidat' is a JSON array of IDs
        $candidateIds = $offer->candidat ?? [];
        $candidates = [];
        
        if (!empty($candidateIds)) {
            $candidates = \App\Models\User::with('profile')
                                         ->whereIn('id', $candidateIds)
                                         ->get();
        }

        return view('recruiter.offer_details', compact('offer', 'candidates'));
    }
}

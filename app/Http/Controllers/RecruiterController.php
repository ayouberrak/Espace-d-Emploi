<?php

namespace App\Http\Controllers;

use App\Models\Recruteur;
use Illuminate\Http\Request;
use App\Models\Offres;
use Carbon\Carbon;

class RecruiterController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        
        $jobs = Offres::where('recruiter_id', $user->id)
                      ->with('entreprise')
                      ->orderBy('created_at', 'desc')
                      ->get();

        $activeJobsCount = 0;  
        $totalApplicants = 0; 
        $myJobs = [];

        foreach ($jobs as $job) {

            $created = Carbon::parse($job->created_at);

            $isActive = $created->diffInDays(now()) < 30 && $job->status !== 'Closed';
            
            if ($isActive) {
                $activeJobsCount++;
            }

            $applicants = $job->candidat ?? [];
            $applicantsCount = is_array($applicants) ? count($applicants) : 0;
            $totalApplicants += $applicantsCount;

            if ($job->status === 'Closed') {
                $displayStatus = 'Clôturé';
            } elseif ($created->diffInDays(now()) < 30) {
                $displayStatus = 'Actif';
            } else {
                $displayStatus = 'Expiré';
            }

            $isReallyActive = $displayStatus === 'Actif';

            $myJobs[] = [
                'id' => $job->id,
                'title' => $job->title,
                'location' => optional($job->entreprise)->location ?? 'Maroc',
                'created_at' => $created->diffForHumans(),
                'applicants_count' => $applicantsCount,
                'status' => $displayStatus,
                'raw_status' => $isReallyActive,
            ];

        }

        $stats = [
            'active_jobs' => $activeJobsCount,
            'total_applicants' => $totalApplicants,

            // random valeur
            'views_this_week' => rand(150, 500), 
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

        $competences = $request->competences
            ? array_map('trim', explode(',', $request->competences))
            : [];

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

        return redirect()
            ->route('mesoffres')
            ->with('success', 'Offre publiée avec succès !');
    }


    public function toggleJobStatus($id)
    {
        $user = auth()->user();

        $offer = Offres::where('id', $id)
                      ->where('recruiter_id', $user->id)
                      ->firstOrFail();

        $offer->status = $offer->status === 'Closed'
                        ? 'Active'
                        : 'Closed';

        $offer->save();
        return back()->with('success', 'Statut de l\'offre mis à jour.');
    }

    public function showJob($id)
    {
        $user = auth()->user();
 
        $offer = Offres::where('id', $id)
                      ->where('recruiter_id', $user->id)
                      ->firstOrFail();
        
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

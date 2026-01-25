<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Mock create view or logic
        return redirect()->route('recruiter.dashboard'); 
    }

    public function storeJob(Request $request)
    {
        // Mock store logic
        return redirect()->route('recruiter.dashboard');
    }
}

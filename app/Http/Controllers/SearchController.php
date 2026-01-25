<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $users = [
        ['id' => 1, 'name' => 'John Doe', 'specialty' => 'Développement Web', 'photo' => 'https://i.pravatar.cc/150?u=1'],
        ['id' => 2, 'name' => 'Jane Smith', 'specialty' => 'Design UX', 'photo' => 'https://i.pravatar.cc/150?u=2'],
        ['id' => 3, 'name' => 'Alex Johnson', 'specialty' => 'Marketing Digital', 'photo' => 'https://i.pravatar.cc/150?u=3'],
        ['id' => 4, 'name' => 'Sam Wilson', 'specialty' => 'Développement Web', 'photo' => 'https://i.pravatar.cc/150?u=4'],
        ['id' => 5, 'name' => 'Lisa Brown', 'specialty' => 'Data Science', 'photo' => 'https://i.pravatar.cc/150?u=5'],
    ];

    public function index(Request $request)
    {
        $query = $request->input('query');
        $specialty = $request->input('specialty');
        
        $results = $this->users;

        if ($query) {
            $results = array_filter($results, function($user) use ($query) {
                return str_contains(strtolower($user['name']), strtolower($query));
            });
        }

        if ($specialty) {
            $results = array_filter($results, function($user) use ($specialty) {
                return str_contains(strtolower($user['specialty']), strtolower($specialty));
            });
        }

        return view('search.index', [
            'results' => $results,
            'query' => $query,
            'specialty' => $specialty
        ]);
    }

    public function developers()
    {
        $developers = array_filter($this->users, function($user) {
            return str_contains(strtolower($user['specialty']), 'développement') || str_contains(strtolower($user['specialty']), 'web');
        });
        return view('search.developers', ['developers' => $developers]);
    }

    public function recruiters()
    {
        $recruiters = [
            ['id' => 101, 'name' => 'TechSolutions', 'industry' => 'Informatique', 'logo' => 'https://logo.clearbit.com/google.com', 'jobs' => 5],
            ['id' => 102, 'name' => 'Creative Agency', 'industry' => 'Design', 'logo' => 'https://logo.clearbit.com/adobe.com', 'jobs' => 2],
            ['id' => 103, 'name' => 'Global Corp', 'industry' => 'Finance', 'logo' => 'https://logo.clearbit.com/stripe.com', 'jobs' => 12],
        ];
        return view('search.recruiters', ['recruiters' => $recruiters]);
    }
}

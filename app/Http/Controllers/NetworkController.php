<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index()
    {
        $requests = [
            [
                'id' => 4,
                'name' => 'Sami Erraji',
                'role' => 'Data Scientist',
                'avatar' => 'https://i.pravatar.cc/150?u=8',
                'mutual_connections' => 12
            ],
            [
                'id' => 6,
                'name' => 'Lina Radiant',
                'role' => 'UX Researcher',
                'avatar' => 'https://i.pravatar.cc/150?u=20',
                'mutual_connections' => 3
            ]
        ];

        $friends = [
            [
                'id' => 1,
                'name' => 'Ahmed Bennani',
                'role' => 'Fullstack Dev',
                'avatar' => 'https://i.pravatar.cc/150?u=1',
                'status' => 'En ligne'
            ],
            [
                'id' => 3,
                'name' => 'Yassine Filali',
                'role' => 'Designer',
                'avatar' => 'https://i.pravatar.cc/150?u=3',
                'status' => 'Hors ligne'
            ],
            [
                'id' => 7,
                'name' => 'Karim Dev',
                'role' => 'Mobile Dev',
                'avatar' => 'https://i.pravatar.cc/150?u=40',
                'status' => 'En ligne'
            ]
        ];

        return view('network.index', compact('requests', 'friends'));
    }
}

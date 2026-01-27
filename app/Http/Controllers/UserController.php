<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller 
{

    public function index()
    {
        $users = User::with('profile')
        ->where('id', '!=', session('user_id'))
        ->get()
        ->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'avatar' =>$user->photo ,
                'specialty' => $user->profile?->title,
                'bio' => $user->profile?->bio ?? $user->bio ,
                'skills' => $user->profile?->skills ,
            ];
        });

        return view('users.index', compact('users'));
    }

    public function offres()
    {
        
        return view('pages.stages', compact('stages'));
    }

    public function recrutement()
    {
        $recruiters = array_filter($this->mockUsers, function($user) {
            return $user['role'] === 'recruiter';
        });
        return view('pages.recrutement', compact('recruiters'));
    }

}

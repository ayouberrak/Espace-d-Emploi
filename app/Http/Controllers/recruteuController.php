<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class recruteuController extends Controller
{
    public function recrutement()
    {
        $recruiters = User::where('role', 'recruiter')
        ->get()
        ->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'avatar' =>$user->photo ,
                'bio' => $user->profile?->bio ?? $user->bio ,
            ];
        });
        return view('pages.recrutement', compact('recruiters'));
    }

}

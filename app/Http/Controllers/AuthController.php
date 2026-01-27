<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function store(Request $method){
            $method->validate([
                'first_name' =>'required|string|max:255',
                'last_name' =>'required|string|max:255',
                'email' =>'required|email|unique:users,email',
                'password' =>'required|confirmed|min:8',
                'role' =>'required|in:devloppeur,recruiter',
            ]);

            
    }

    public function showRegister()
    {
        return view('auth.register');
    }
}

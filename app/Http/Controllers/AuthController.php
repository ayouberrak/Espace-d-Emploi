<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use App\Models\Recruteur;
use App\Models\Developpeur;

class AuthController extends Controller 
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            session([
                'role' => $user->role,
                'user_id' => $user->id,
            ]);



            if ($user->role === 'recruiter') {
                return redirect()->route('recruiter.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


    public function store(Request $method){
            $method->validate([
                'first_name' =>'required|string|max:255',
                'last_name' =>'required|string|max:255',
                'email' =>'required|email|unique:users,email',
                'password' =>'required|confirmed|min:8',
                'role' =>'required|in:devloppeur,recruiter',
            ]);


            if($method->input('role') == 'recruiter'){
                $user = Recruteur::create([
                    'name' => $method->input('first_name').' '.$method->input('last_name'),
                    'email' =>$method->input('email'),
                    'password'=>Hash::make($method->input('password')),
                    'role'=> 'recruiter'
                ]);
            }else{
                $user = Developpeur::create([
                    'name' => $method->input('first_name').' '.$method->input('last_name'),
                    'email' =>$method->input('email'),
                    'password'=>Hash::make($method->input('password')),
                    'role'=> 'devloppeur'
                ]);
            }

            Auth::login($user);
            return redirect()->route('dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
}

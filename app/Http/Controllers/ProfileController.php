<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    public function profile($id){
        $user = User::with('profile')->findOrFail($id);

        $isMe = Auth::id() === $user->id;

        return view('users.profile',['user'=>$user , 'isMe' => $isMe]);
    }
    
}

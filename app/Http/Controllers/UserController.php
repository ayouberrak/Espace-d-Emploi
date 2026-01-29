<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offres;
use App\Models\Invitation;

class UserController extends Controller 
{

public function index()
{
    $authUser = User::find(session('user_id'));

        
        $amisIds = $authUser->amis ?? [];

        $invitationUserIds = Invitation::where(function ($q) use ($authUser) {
                $q->where('sender_id', $authUser->id)
                  ->orWhere('resever_id', $authUser->id);
            })
            ->whereIn('status', ['pending', 'accepted'])
            ->get()
            ->flatMap(function ($inv) use ($authUser) {
                return [
                    $inv->sender_id == $authUser->id ? $inv->resever_id : $inv->sender_id
                ];
            })
            ->unique()
            ->values()
            ->all();

        $excludedIds = array_unique(array_merge($amisIds, $invitationUserIds));
    
    $users = User::with('profile')
        ->where('id', '!=', $authUser->id)
            ->whereNotIn('id', $excludedIds)
        ->get()
        ->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'avatar' => $user->photo,
                'specialty' => $user->profile?->title,
                'bio' => $user->profile?->bio ?? $user->bio,
                'skills' => $user->profile?->skills,
            ];
        });

    return view('users.index', compact('users'));
}


}

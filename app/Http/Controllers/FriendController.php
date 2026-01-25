<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function add($id)
    {
        return redirect()->back()->with('success', 'Demande d\'ami envoyée !');
    }

    public function notifications()
    {
        $notifications = [
            ['id' => 1, 'type' => 'friend_request', 'message' => 'Jane Smith vous a envoyé une demande d\'ami.', 'created_at' => 'Il y a 5 min'],
            ['id' => 2, 'type' => 'job_alert', 'message' => 'Nouveau poste : Développeur PHP chez Google.', 'created_at' => 'Il y a 1 heure'],
        ];
        return view('notifications.index', compact('notifications'));
    }
}

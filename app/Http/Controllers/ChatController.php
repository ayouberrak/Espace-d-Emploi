<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = [
            [
                'id' => 1,
                'name' => 'Oulaya Mansouri',
                'role' => 'Recruteur',
                'avatar' => 'https://i.pravatar.cc/150?u=5',
                'last_message' => 'Bonjour Ayoub, votre profil nous intéresse !',
                'time' => '10:30',
                'unread' => 2,
                'online' => true
            ],
            [
                'id' => 2,
                'name' => 'Ahmed Bennani',
                'role' => 'Développeur',
                'avatar' => 'https://i.pravatar.cc/150?u=1',
                'last_message' => 'Tu as vu la dernière mise à jour de Laravel ?',
                'time' => 'Hier',
                'unread' => 0,
                'online' => false
            ],
            [
                'id' => 3,
                'name' => 'Sarah Tech',
                'role' => 'CTO',
                'avatar' => 'https://i.pravatar.cc/150?u=9',
                'last_message' => 'On peut programmer un call demain ?',
                'time' => 'Hier',
                'unread' => 0,
                'online' => true
            ]
        ];

        $activeConversation = [
            'user' => $conversations[0],
            'messages' => [
                ['id' => 1, 'sender' => 'them', 'text' => 'Bonjour Ayoub !', 'time' => '10:00'],
                ['id' => 2, 'sender' => 'them', 'text' => 'J\'ai vu votre portfolio, impressionnant.', 'time' => '10:01'],
                ['id' => 3, 'sender' => 'me', 'text' => 'Merci Oulaya ! Ravi que ça vous plaise.', 'time' => '10:05'],
                ['id' => 4, 'sender' => 'them', 'text' => 'Bonjour Ayoub, votre profil nous intéresse ! Êtes-vous disponible pour un entretien ?', 'time' => '10:30'],
            ]
        ];

        return view('chat.index', compact('conversations', 'activeConversation'));
    }
}

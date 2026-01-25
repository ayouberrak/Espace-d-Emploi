<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Données mockées pour l'utilisateur connecté
    private $currentUser = [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'photo' => 'https://ui-avatars.com/api/?name=John+Doe&background=random',
        'bio' => 'Développeur Fullstack passionné par Laravel et le design.',
        'specialty' => 'Développement Web',
        'role' => 'Chercheur d’emploi',
    ];

    public function show($id = null)
    {
        // En mode statique, on renvoie toujours le profil mocké ou un autre
        $user = $this->currentUser;
        if ($id && $id != 1) {
            $user = [
                'id' => $id,
                'name' => 'Utilisateur ' . $id,
                'photo' => 'https://ui-avatars.com/api/?name=User+' . $id . '&background=random',
                'bio' => 'Ceci est la bio d\'un autre utilisateur pour la démo.',
                'specialty' => 'Design UX',
                'role' => 'Recruteur',
            ];
        }
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = $this->currentUser;
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // On simule une mise à jour réussie avec une notification
        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
    {
        return redirect()->back()->with('success', 'Mot de passe changé avec succès !');
    }
}

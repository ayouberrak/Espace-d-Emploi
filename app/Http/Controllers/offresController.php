<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offres;

class offresController extends Controller
{
    public function offres()
    {
        $offres = Offres::all()->map(function($offre) {
            return [
                'offre' => [
                    'id' => $offre->id,
                    'title' => $offre->title,
                    'description' => $offre->description,
                    'type' => $offre->ofres_type,   
                    'durre' => $offre->durre,
                    'created_at' => $offre->created_at,
                    'competences' => $offre->competences,
                    'candidats' => $offre->candidat,
                ],

                'entrepris' => [
                    'id' => $offre->entreprise->id ,
                    'name' => $offre->entreprise->name ,
                    'location' => $offre->entreprise->location ,
                    'logo' => $offre->entreprise->logo ,
                ]
            ];
        });
        return view('pages.offres', compact('offres'));
    }


    public function offreDetails($id)
    {
        $offre = Offres::with('entreprise')->findOrFail($id);

        return view('pages.offreDetails', [
            'offre' => $offre,
            'entreprise' => $offre->entreprise,
        ]);
    }

    public function postuler($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $offre = Offres::findOrFail($id);
        $userId = auth()->id();
        $candidats = $offre->candidat ?? [];

        if (!in_array($userId, $candidats)) {
            $candidats[] = $userId;
            $offre->candidat = $candidats;
            $offre->save();
        }

        return back()->with('success', 'Votre candidature a été envoyée avec succès !');
    }

    public function ofresByRecruteur()
    {
        if (!auth()->check() || auth()->user()->role !== 'recruiter') {
            return redirect()->route('login');
        }

        $user = auth()->user();
        // Assuming Recruteur model logic applies to User instance or we re-query as Recruteur
        $recruiter = \App\Models\Recruteur::find($user->id); 
        
        $entreprise = $recruiter->entreprises()->first(); 
        $offres = $recruiter->offres()->get();

        return view('pages.recruiter_offres', compact('recruiter', 'entreprise', 'offres'));
    }
}

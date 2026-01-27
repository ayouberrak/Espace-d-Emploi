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
                ],

                'entrepris' => [
                    'id' => $offre->entreprise->id ,
                    'name' => $offre->entreprise->name ,
                    'location' => $offre->entreprise->location ,
                ]
            ];
        });
        return view('pages.offres', compact('offres'));
    }
}

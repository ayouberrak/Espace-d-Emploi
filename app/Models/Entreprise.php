<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $table = 'entrprise';

    protected $fillable = [
        'nom',
        'logo',
        'description',
        'location',
        'recruiter_id',
        'create',
    ];

    public $timestamps = false; 

    public function recruiter()
    {
        return $this->belongsTo(Recruteur::class, 'recruiter_id');
    }

    public function offres()
    {
        return $this->hasMany(Offres::class, 'enptrise_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    protected $table = 'ofres';

    protected $fillable = [
        'enptrise_id',
        'recruiter_id',
        'title',
        'description',
        'ofres_type',
        'durre',
        'created_at',
    ];

    public $timestamps = false; 

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'enptrise_id');
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruteur::class, 'recruiter_id');
    }
}

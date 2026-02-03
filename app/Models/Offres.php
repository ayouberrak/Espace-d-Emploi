<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    use HasFactory;
    protected $table = 'ofres';

    protected $fillable = [
        'enptrise_id',
        'recruiter_id',
        'title',
        'description',
        'ofres_type',
        'durre',
        'created_at',
        'competences',
        'status',
    ];
    protected $casts = [
        'candidat' => 'array',
        'competences' => 'array',
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

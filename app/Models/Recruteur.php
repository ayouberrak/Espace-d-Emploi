<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Recruteur extends User
{
    protected static function booted()
    {
        static::addGlobalScope('recruiter', function (Builder $query) {
            $query->where('role', 'recruiter');
        });
    }

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class, 'recruiter_id');
    }

    public function offres()
    {
        return $this->hasMany(Offres::class, 'recruiter_id');
    }
}

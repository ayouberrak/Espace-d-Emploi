<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Developpeur extends User
{
    protected static function booted()
    {
        static::addGlobalScope('devloppeur', function (Builder $query) {
            $query->where('role', 'devloppeur');
        });
    }

    public function profile()
    {
        return $this->hasOne(Profil::class, 'user_id');
    }
}

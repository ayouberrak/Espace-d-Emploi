<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'title',
        'bio',
        'skills',
        'experiances',
        'projects',
    ];

    protected $casts = [
        'skills' => 'array',
        'experiances' => 'array',
        'projects' => 'array',
    ];

    public $timestamps = false; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

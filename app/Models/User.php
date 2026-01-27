<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

abstract class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
        'bio',
        'phone',
        'amis',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'amis' => 'array',
    ];

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'resever_id');
    }

    public function invitationsSent()
    {
        return $this->hasMany(Invitation::class, 'sender_id');
    }

    public function invitationsReceived()
    {
        return $this->hasMany(Invitation::class, 'resever_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'user_id');
    }
}

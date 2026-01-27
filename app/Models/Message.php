<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $table = 'message';

    protected $fillable = [
        'sender_id',
        'resever_id',
        'content',
        'sender_at',
    ];

    public $timestamps = false; 

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'resever_id');
    }
}

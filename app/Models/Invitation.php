<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invitation extends Model
{
    protected $table = 'invi';

    protected $fillable = [
        'sender_id',
        'resever_id',
        'status',
        'created_at',
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

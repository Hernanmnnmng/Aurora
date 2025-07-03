<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'gebruiker_id',
        'content',
        'rating',
    ];

    public function gebruiker()
    {
        return $this->belongsTo(\App\Models\User::class, 'gebruiker_id');
    }
}
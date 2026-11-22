<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'type',
        'genre',
        'rating',
        'total_episodes',
    ];

    protected $casts = [
        'rating' => 'float',
        'total_episodes' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

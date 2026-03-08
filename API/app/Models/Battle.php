<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
        'result',
        'arc',
        'date',
        'location',
        'location_data',
        'participants',
        'nonDirectParticipants',
        'image',
    ];

    protected $casts = [
        'participants'          => 'array',
        'nonDirectParticipants' => 'array',
    ];
}

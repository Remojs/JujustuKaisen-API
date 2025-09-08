<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursedTechnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'technique_name',
        'description',
        'category',
        'users',
        'hand_signs',
        'effects'
    ];

    protected $casts = [
        'users' => 'array',
        'hand_signs' => 'array',
        'effects' => 'array'
    ];
}

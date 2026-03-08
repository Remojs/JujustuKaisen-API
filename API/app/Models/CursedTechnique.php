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
        'type',
        'range',
        'users',
        'image',
    ];

    protected $casts = [
        'users' => 'array',
    ];
}

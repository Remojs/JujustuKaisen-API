<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursedTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'owners',
        'description',
        'image',
    ];

    protected $casts = [
        'owners' => 'array',
    ];
}

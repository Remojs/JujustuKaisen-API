<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursedTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_name',
        'description',
        'tooltype',
        'grade',
        'abilities',
        'current_owner',
        'previous_owners',
        'image'
    ];

    protected $casts = [
        'abilities' => 'array',
        'previous_owners' => 'array'
    ];
}

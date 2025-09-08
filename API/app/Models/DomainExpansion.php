<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainExpansion extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name',
        'user',
        'description',
        'sure_hit_effect',
        'capabilities',
        'weaknesses',
        'image'
    ];

    protected $casts = [
        'capabilities' => 'array',
        'weaknesses' => 'array'
    ];
}

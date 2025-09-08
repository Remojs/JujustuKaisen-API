<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'species_name',
        'description',
        'abilities',
        'characteristics',
        'image'
    ];

    protected $casts = [
        'abilities' => 'array',
        'characteristics' => 'array'
    ];

    // Relationship: has many Characters
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'speciesId');
    }
}

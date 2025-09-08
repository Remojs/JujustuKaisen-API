<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'locationType',
        'characterId',
        'details',
        'events',
        'associated_chapters',
        'image'
    ];

    protected $casts = [
        'events' => 'array',
        'associated_chapters' => 'array'
    ];

    // Relationship: characterId -> Character
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'characterId');
    }
}

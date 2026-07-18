<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Technique extends Model
{
    use HasFactory;

    protected $fillable = [
        'technique_name',
        'technique_type',
        'characterId',
        'description',
        'usage',
        'image'
    ];

    // Relationship: characterId -> Character
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'characterId');
    }
}

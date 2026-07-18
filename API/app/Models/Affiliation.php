<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affiliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliation_name',
        'type',
        'controlled_by',
        'location',
        'location_data',
        'description',
        'image'
    ];

    // Relationship: controlled_by -> Character
    public function controller(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'controlled_by');
    }
}

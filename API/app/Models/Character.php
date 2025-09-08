<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\GenderEnum;
use App\Enums\StatusEnum;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_name',
        'series',
        'age',
        'birthday',
        'height',
        'weight',
        'species',
        'speciesId',
        'occupation',
        'grade',
        'clan',
        'origin',
        'affiliation',
        'affiliationId',
        'gender',
        'status',
        'abilities',
        'domain_expansion',
        'cursed_technique',
        'cursed_energy_nature',
        'personality',
        'appearance',
        'background',
        'relatives',
        'first_appearance_manga',
        'first_appearance_anime',
        'voice_actors',
        'quote',
        'image'
    ];

    protected $casts = [
        'occupation' => 'array',
        'abilities' => 'array',
        'relatives' => 'array',
        'voice_actors' => 'array',
        'gender' => GenderEnum::class,
        'status' => StatusEnum::class
    ];

    // Relationship: speciesId -> Species
    public function speciesData(): BelongsTo
    {
        return $this->belongsTo(Species::class, 'speciesId');
    }

    // Relationship: affiliationId -> Affiliation
    public function affiliationData(): BelongsTo
    {
        return $this->belongsTo(Affiliation::class, 'affiliationId');
    }

    // Relationship: has many Techniques
    public function techniques(): HasMany
    {
        return $this->hasMany(Technique::class, 'characterId');
    }

    // Relationship: has many Locations
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'characterId');
    }
}

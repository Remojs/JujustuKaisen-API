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
        'id',
        'name',
        'alias',
        'speciesId',
        'birthday',
        'height',
        'age',
        'gender',
        'occupationId',
        'affiliationId',
        'animeDebut',
        'mangaDebut',
        'cursedTechniquesIds',
        'gradeId',
        'domainExpansionId',
        'battlesId',
        'cursedToolId',
        'status',
        'relatives',
        'image'
    ];

    protected $casts = [
        'alias' => 'array',
        'occupationId' => 'array',
        'affiliationId' => 'array',
        'cursedTechniquesIds' => 'array',
        'battlesId' => 'array',
        'cursedToolId' => 'array',
        'relatives' => 'array',
        'gender' => 'integer',
        'status' => 'integer'
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

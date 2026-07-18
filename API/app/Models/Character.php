<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'image',
    ];

    protected $casts = [
        'alias'               => 'array',
        'occupationId'        => 'array',
        'affiliationId'       => 'array',
        'cursedTechniquesIds' => 'array',
        'battlesId'           => 'array',
        'cursedToolId'        => 'array',
        'relatives'           => 'array',
        'gender'              => 'integer',
        'status'              => 'integer',
    ];

    // Relación con Species (especieId -> species.id)
    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class, 'speciesId');
    }

    // Relación con DomainExpansion (domainExpansionId -> domain_expansions.id)
    public function domainExpansion(): BelongsTo
    {
        return $this->belongsTo(DomainExpansion::class, 'domainExpansionId');
    }
}
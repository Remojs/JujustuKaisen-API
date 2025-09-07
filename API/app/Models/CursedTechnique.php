<?php

namespace App\Models;

use App\Constants\TechniqueTypeConstants;
use App\Constants\TechniqueRangeConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CursedTechnique extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'type_id',
        'range_id',
        'requirements',
        'limitations',
        'first_appearance_manga',
        'first_appearance_anime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requirements' => 'array',
        'limitations' => 'array',
    ];

    /**
     * Get all characters that can use this cursed technique.
     */
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_cursed_technique');
    }

    /**
     * Get all domain expansions that use this technique.
     */
    public function domainExpansions(): HasMany
    {
        return $this->hasMany(DomainExpansion::class);
    }

    /**
     * Get the technique type name.
     */
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn () => TechniqueTypeConstants::getName($this->type_id),
        );
    }

    /**
     * Get the technique range name.
     */
    protected function rangeName(): Attribute
    {
        return Attribute::make(
            get: fn () => TechniqueRangeConstants::getName($this->range_id),
        );
    }

    /**
     * Scope a query to search techniques by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeByType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    /**
     * Scope a query to filter by range.
     */
    public function scopeByRange($query, $rangeId)
    {
        return $query->where('range_id', $rangeId);
    }
}

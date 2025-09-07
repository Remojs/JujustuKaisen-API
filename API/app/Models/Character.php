<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Constants\SpeciesConstants;
use App\Constants\GradeConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Character extends Model
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
        'image',
        'gender',
        'age',
        'birthday',
        'height',
        'weight',
        'hair_color',
        'eye_color',
        'status',
        'species_id',
        'grade_id',
        'location_id',
        'abilities',
        'first_appearance_manga',
        'first_appearance_anime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gender' => GenderEnum::class,
        'status' => StatusEnum::class,
        'abilities' => 'array',
        'birthday' => 'date',
    ];

    /**
     * Get the location this character is from.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get all occupations for this character.
     */
    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'character_occupation');
    }

    /**
     * Get all affiliations for this character.
     */
    public function affiliations(): BelongsToMany
    {
        return $this->belongsToMany(Affiliation::class, 'character_affiliation');
    }

    /**
     * Get all cursed techniques this character can use.
     */
    public function cursedTechniques(): BelongsToMany
    {
        return $this->belongsToMany(CursedTechnique::class, 'character_cursed_technique');
    }

    /**
     * Get all cursed tools this character can use.
     */
    public function cursedTools(): BelongsToMany
    {
        return $this->belongsToMany(CursedTool::class, 'character_cursed_tool');
    }

    /**
     * Get all battles this character participated in directly.
     */
    public function battles(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'battle_participant');
    }

    /**
     * Get all battles this character was involved in indirectly.
     */
    public function nonDirectBattles(): BelongsToMany
    {
        return $this->belongsToMany(Battle::class, 'battle_non_direct_participant');
    }

    /**
     * Get all battles (both direct and indirect participation).
     */
    public function allBattles()
    {
        return Battle::whereIn('id', 
            $this->battles()->pluck('battles.id')
                ->merge($this->nonDirectBattles()->pluck('battles.id'))
                ->unique()
        );
    }

    /**
     * Get the species name.
     */
    protected function speciesName(): Attribute
    {
        return Attribute::make(
            get: fn () => SpeciesConstants::getName($this->species_id),
        );
    }

    /**
     * Get the grade name.
     */
    protected function gradeName(): Attribute
    {
        return Attribute::make(
            get: fn () => GradeConstants::getName($this->grade_id),
        );
    }

    /**
     * Scope a query to search characters by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by gender.
     */
    public function scopeByGender($query, GenderEnum $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, StatusEnum $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by species.
     */
    public function scopeBySpecies($query, $speciesId)
    {
        return $query->where('species_id', $speciesId);
    }

    /**
     * Scope a query to filter by grade.
     */
    public function scopeByGrade($query, $gradeId)
    {
        return $query->where('grade_id', $gradeId);
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    /**
     * Scope a query to include all relationships for full character data.
     */
    public function scopeWithFullData($query)
    {
        return $query->with([
            'location',
            'occupations',
            'affiliations',
            'cursedTechniques',
            'cursedTools',
            'battles',
            'nonDirectBattles'
        ]);
    }
}

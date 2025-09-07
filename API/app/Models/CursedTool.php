<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CursedTool extends Model
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
        'type',
        'grade',
        'abilities',
        'current_owner',
        'previous_owners',
        'origin',
        'first_appearance_manga',
        'first_appearance_anime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'abilities' => 'array',
        'previous_owners' => 'array',
    ];

    /**
     * Get all characters that can use this cursed tool.
     */
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_cursed_tool');
    }

    /**
     * Get the current owner as a Character model.
     */
    protected function currentOwnerCharacter(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->current_owner) {
                    return null;
                }
                return Character::where('name', $this->current_owner)->first();
            }
        );
    }

    /**
     * Scope a query to search tools by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to filter by grade.
     */
    public function scopeByGrade($query, $grade)
    {
        return $query->where('grade', $grade);
    }

    /**
     * Scope a query to filter by current owner.
     */
    public function scopeByOwner($query, $owner)
    {
        return $query->where('current_owner', $owner);
    }
}

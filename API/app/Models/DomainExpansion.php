<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainExpansion extends Model
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
        'cursed_technique_id',
        'user',
        'sure_hit_effect',
        'capabilities',
        'weaknesses',
        'first_appearance_manga',
        'first_appearance_anime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'capabilities' => 'array',
        'weaknesses' => 'array',
    ];

    /**
     * Get the cursed technique this domain expansion is based on.
     */
    public function cursedTechnique(): BelongsTo
    {
        return $this->belongsTo(CursedTechnique::class);
    }

    /**
     * Get the user as a Character model.
     */
    public function userCharacter()
    {
        if (!$this->user) {
            return null;
        }
        return Character::where('name', $this->user)->first();
    }

    /**
     * Scope a query to search domain expansions by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('user', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeByUser($query, $user)
    {
        return $query->where('user', $user);
    }
}

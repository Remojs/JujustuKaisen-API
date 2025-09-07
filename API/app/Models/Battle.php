<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Battle extends Model
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
        'location_id',
        'outcome',
        'events',
        'manga_chapters',
        'anime_episodes',
        'arc_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'events' => 'array',
        'manga_chapters' => 'array',
        'anime_episodes' => 'array',
    ];

    /**
     * Get the location where this battle took place.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get all direct participants in this battle.
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'battle_participant');
    }

    /**
     * Get all non-direct participants in this battle.
     */
    public function nonDirectParticipants(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'battle_non_direct_participant');
    }

    /**
     * Get all participants (both direct and indirect).
     */
    public function allParticipants()
    {
        return Character::whereIn('id', 
            $this->participants()->pluck('characters.id')
                ->merge($this->nonDirectParticipants()->pluck('characters.id'))
                ->unique()
        );
    }

    /**
     * Scope a query to search battles by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('arc_name', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by arc.
     */
    public function scopeByArc($query, $arcName)
    {
        return $query->where('arc_name', $arcName);
    }

    /**
     * Scope a query to filter by outcome.
     */
    public function scopeByOutcome($query, $outcome)
    {
        return $query->where('outcome', 'like', "%{$outcome}%");
    }

    /**
     * Scope a query to include all relationships for full battle data.
     */
    public function scopeWithFullData($query)
    {
        return $query->with([
            'location',
            'participants',
            'nonDirectParticipants'
        ]);
    }
}

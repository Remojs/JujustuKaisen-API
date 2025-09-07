<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeEpisode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'episode_number',
        'season',
        'air_date',
        'description',
        'manga_chapters_adapted',
        'runtime_minutes',
        'director',
        'writer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'air_date' => 'date',
        'manga_chapters_adapted' => 'array',
        'episode_number' => 'integer',
        'season' => 'integer',
        'runtime_minutes' => 'integer',
    ];

    /**
     * Scope a query to search episodes by title or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by season.
     */
    public function scopeBySeason($query, $season)
    {
        return $query->where('season', $season);
    }

    /**
     * Scope a query to order by episode number.
     */
    public function scopeInOrder($query)
    {
        return $query->orderBy('season')->orderBy('episode_number');
    }

    /**
     * Scope a query to filter by air date range.
     */
    public function scopeByDateRange($query, $startDate = null, $endDate = null)
    {
        if ($startDate) {
            $query->where('air_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('air_date', '<=', $endDate);
        }
        return $query;
    }
}

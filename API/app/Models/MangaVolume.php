<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaVolume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'volume_number',
        'release_date',
        'chapters',
        'cover_image',
        'isbn',
        'page_count',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'chapters' => 'array',
        'volume_number' => 'integer',
        'page_count' => 'integer',
    ];

    /**
     * Scope a query to search volumes by title or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
    }

    /**
     * Scope a query to order by volume number.
     */
    public function scopeInOrder($query)
    {
        return $query->orderBy('volume_number');
    }

    /**
     * Scope a query to filter by release date range.
     */
    public function scopeByDateRange($query, $startDate = null, $endDate = null)
    {
        if ($startDate) {
            $query->where('release_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('release_date', '<=', $endDate);
        }
        return $query;
    }

    /**
     * Get the chapter range as a formatted string.
     */
    public function getChapterRangeAttribute()
    {
        if (!$this->chapters || empty($this->chapters)) {
            return null;
        }
        
        $chapters = $this->chapters;
        if (count($chapters) === 1) {
            return "Chapter {$chapters[0]}";
        }
        
        return "Chapters " . min($chapters) . "-" . max($chapters);
    }
}

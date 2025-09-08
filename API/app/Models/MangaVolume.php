<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaVolume extends Model
{
    use HasFactory;

    protected $fillable = [
        'volume_number',
        'title',
        'chapters',
        'arc',
        'cover_image',
        'release_date'
    ];

    protected $casts = [
        'chapters' => 'array'
    ];
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

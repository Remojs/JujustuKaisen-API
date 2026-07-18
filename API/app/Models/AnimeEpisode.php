<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimeEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'episode_number',
        'arc',
        'season',
        'title',
        'mangachapters_adapted',
        'air_date',
        'opening_theme',
        'ending_theme',
        'image'
    ];

    // Relationship: arc -> Arc
    public function arcData(): BelongsTo
    {
        return $this->belongsTo(Arc::class, 'arc');
    }
}

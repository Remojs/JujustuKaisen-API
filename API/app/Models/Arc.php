<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arc extends Model
{
    use HasFactory;

    protected $fillable = [
        'arc_name',
        'arctype',
        'arc_number',
        'arc_part',
        'anime_season',
        'image'
    ];

    // Relationship: arc -> AnimeEpisode
    public function animeEpisodes(): HasMany
    {
        return $this->hasMany(AnimeEpisode::class, 'arc');
    }

    // Relationship: arc -> MangaChapter
    public function mangaChapters(): HasMany
    {
        return $this->hasMany(MangaChapter::class, 'arc');
    }
}

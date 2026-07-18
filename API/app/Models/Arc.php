<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manga',
        'anime',
        'image',
    ];

    protected $casts = [
        'anime' => 'array',
    ];

    public function animeEpisodes(): HasMany
    {
        return $this->hasMany(AnimeEpisode::class, 'arc');
    }
}

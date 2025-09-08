<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Battle extends Model
{
    use HasFactory;

    protected $fillable = [
        'fight_name',
        'description',
        'arc_name',
        'characters',
        'manga_chapters',
        'anime_episodes',
        'outcome',
        'image'
    ];

    protected $casts = [
        'characters' => 'array',
        'manga_chapters' => 'array',
        'anime_episodes' => 'array'
    ];

    // Relationship: arc_name -> Arc (by arc_name field)
    public function arc(): BelongsTo
    {
        return $this->belongsTo(Arc::class, 'arc_name', 'arc_name');
    }
}

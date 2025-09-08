<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MangaChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_number',
        'arc',
        'title',
        'pages',
        'release_date',
        'cover_image'
    ];

    // Relationship: arc -> Arc
    public function arcData(): BelongsTo
    {
        return $this->belongsTo(Arc::class, 'arc');
    }
}

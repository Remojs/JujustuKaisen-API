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

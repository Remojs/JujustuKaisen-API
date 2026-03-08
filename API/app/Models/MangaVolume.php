<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaVolume extends Model
{
    use HasFactory;

    protected $fillable = [
        'volume_number',
        'volume_name',
        'release_date',
        'pages',
        'chapters',
        'cover_character',
        'image',
    ];
}

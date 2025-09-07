<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'manga_chapters',
        'anime_episodes',
        'order',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'manga_chapters' => 'array',
        'anime_episodes' => 'array',
        'order' => 'integer',
    ];

    /**
     * Get all battles in this arc.
     */
    public function battles()
    {
        return Battle::where('arc_name', $this->name);
    }

    /**
     * Scope a query to search arcs by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to order by arc order.
     */
    public function scopeInOrder($query)
    {
        return $query->orderBy('order');
    }
}

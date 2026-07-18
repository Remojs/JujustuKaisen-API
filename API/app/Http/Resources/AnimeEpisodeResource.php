<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimeEpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'episode_number' => $this->episode_number,
            'season' => $this->season,
            'air_date' => $this->air_date?->format('Y-m-d'),
            'description' => $this->description,
            'manga_chapters_adapted' => $this->manga_chapters_adapted,
            'runtime_minutes' => $this->runtime_minutes,
            'director' => $this->director,
            'writer' => $this->writer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MangaVolumeResource extends JsonResource
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
            'volume_number' => $this->volume_number,
            'release_date' => $this->release_date?->format('Y-m-d'),
            'chapters' => $this->chapters,
            'chapter_range' => $this->chapter_range,
            'cover_image' => $this->cover_image,
            'isbn' => $this->isbn,
            'page_count' => $this->page_count,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

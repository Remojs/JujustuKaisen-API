<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BattleResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'outcome' => $this->outcome,
            'events' => $this->events,
            'manga_chapters' => $this->manga_chapters,
            'anime_episodes' => $this->anime_episodes,
            'arc_name' => $this->arc_name,
            'location' => new LocationResource($this->whenLoaded('location')),
            'participants' => CharacterResource::collection($this->whenLoaded('participants')),
            'non_direct_participants' => CharacterResource::collection($this->whenLoaded('nonDirectParticipants')),
            'participants_count' => $this->whenCounted('participants'),
            'non_direct_participants_count' => $this->whenCounted('nonDirectParticipants'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

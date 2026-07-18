<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CursedToolResource extends JsonResource
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
            'type' => $this->type,
            'grade' => $this->grade,
            'abilities' => $this->abilities,
            'current_owner' => $this->current_owner,
            'previous_owners' => $this->previous_owners,
            'origin' => $this->origin,
            'first_appearance_manga' => $this->first_appearance_manga,
            'first_appearance_anime' => $this->first_appearance_anime,
            'users_count' => $this->whenCounted('characters'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

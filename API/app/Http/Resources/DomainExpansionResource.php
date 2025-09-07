<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DomainExpansionResource extends JsonResource
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
            'user' => $this->user,
            'sure_hit_effect' => $this->sure_hit_effect,
            'capabilities' => $this->capabilities,
            'weaknesses' => $this->weaknesses,
            'first_appearance_manga' => $this->first_appearance_manga,
            'first_appearance_anime' => $this->first_appearance_anime,
            'cursed_technique' => new CursedTechniqueResource($this->whenLoaded('cursedTechnique')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

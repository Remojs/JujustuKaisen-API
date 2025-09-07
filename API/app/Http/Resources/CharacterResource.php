<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
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
            'image' => $this->image,
            'gender' => $this->gender?->label(),
            'age' => $this->age,
            'birthday' => $this->birthday?->format('Y-m-d'),
            'height' => $this->height,
            'weight' => $this->weight,
            'hair_color' => $this->hair_color,
            'eye_color' => $this->eye_color,
            'status' => $this->status?->label(),
            'species' => $this->species_name,
            'grade' => $this->grade_name,
            'location' => new LocationResource($this->whenLoaded('location')),
            'abilities' => $this->abilities,
            'first_appearance_manga' => $this->first_appearance_manga,
            'first_appearance_anime' => $this->first_appearance_anime,
            'occupations' => OccupationResource::collection($this->whenLoaded('occupations')),
            'affiliations' => AffiliationResource::collection($this->whenLoaded('affiliations')),
            'cursed_techniques' => CursedTechniqueResource::collection($this->whenLoaded('cursedTechniques')),
            'cursed_tools' => CursedToolResource::collection($this->whenLoaded('cursedTools')),
            'battles' => BattleResource::collection($this->whenLoaded('battles')),
            'non_direct_battles' => BattleResource::collection($this->whenLoaded('nonDirectBattles')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

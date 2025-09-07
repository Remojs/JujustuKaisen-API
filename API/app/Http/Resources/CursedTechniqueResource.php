<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CursedTechniqueResource extends JsonResource
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
            'type' => $this->type_name,
            'range' => $this->range_name,
            'requirements' => $this->requirements,
            'limitations' => $this->limitations,
            'first_appearance_manga' => $this->first_appearance_manga,
            'first_appearance_anime' => $this->first_appearance_anime,
            'users_count' => $this->whenCounted('characters'),
            'domain_expansions' => DomainExpansionResource::collection($this->whenLoaded('domainExpansions')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

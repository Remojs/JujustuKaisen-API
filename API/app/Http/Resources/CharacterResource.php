<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'alias'               => $this->alias,
            'speciesId'           => $this->speciesId,
            'birthday'            => $this->birthday,
            'height'              => $this->height,
            'age'                 => $this->age,
            'gender'              => $this->gender,
            'occupationId'        => $this->occupationId,
            'affiliationId'       => $this->affiliationId,
            'animeDebut'          => $this->animeDebut,
            'mangaDebut'          => $this->mangaDebut,
            'cursedTechniquesIds' => $this->cursedTechniquesIds,
            'gradeId'             => $this->gradeId,
            'domainExpansionId'   => $this->domainExpansionId,
            'battlesId'           => $this->battlesId,
            'cursedToolId'        => $this->cursedToolId,
            'status'              => $this->status,
            'relatives'           => $this->relatives,
            'image'               => $this->image,
        ];
    }
}

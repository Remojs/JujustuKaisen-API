<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Character;
use App\Constants\TechniqueTypeConstants;
use App\Constants\TechniqueRangeConstants;

class CursedTechniqueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'technique_name' => $this->technique_name,
            'description'    => $this->description,
            'type'           => $this->type
                                    ? ['id' => $this->type, 'name' => TechniqueTypeConstants::getName($this->type)]
                                    : null,
            'range'          => $this->range
                                    ? ['id' => $this->range, 'name' => TechniqueRangeConstants::getName($this->range)]
                                    : null,
            'users'          => Character::whereIn('id', $this->users ?? [])->get(['id', 'name', 'image']),
            'image'          => $this->image,
        ];
    }
}

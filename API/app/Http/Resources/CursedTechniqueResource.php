<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CursedTechniqueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'technique_name' => $this->technique_name,
            'description'    => $this->description,
            'type'           => $this->type,
            'range'          => $this->range,
            'users'          => $this->users,
            'image'          => $this->image,
        ];
    }
}

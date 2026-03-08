<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Character;

class DomainExpansionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'user'        => $this->user
                                ? Character::find($this->user, ['id', 'name', 'image'])
                                : null,
            'range'       => $this->range,
            'Type'        => $this->Type,
            'description' => $this->description,
            'image'       => $this->image,
        ];
    }
}

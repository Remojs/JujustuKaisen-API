<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Character;
use App\Models\Location;

class AffiliationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'affiliation_name' => $this->affiliation_name,
            'type'             => $this->type,
            'controlled_by'    => $this->controlled_by
                                    ? Character::find($this->controlled_by, ['id', 'name', 'image'])
                                    : null,
            'location'         => $this->location,
            'location_data'    => $this->location_data
                                    ? Location::find($this->location_data)
                                    : null,
            'description'      => $this->description,
            'image'            => $this->image,
        ];
    }
}

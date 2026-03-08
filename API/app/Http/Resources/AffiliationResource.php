<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AffiliationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'affiliation_name' => $this->affiliation_name,
            'type'             => $this->type,
            'controlled_by'    => $this->controlled_by,
            'location'         => $this->location,
            'location_data'    => $this->location_data,
            'description'      => $this->description,
            'image'            => $this->image,
        ];
    }
}

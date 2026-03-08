<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BattleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'event'                 => $this->event,
            'result'                => $this->result,
            'arc'                   => $this->arc,
            'date'                  => $this->date,
            'location'              => $this->location,
            'location_data'         => $this->location_data,
            'participants'          => $this->participants,
            'nonDirectParticipants' => $this->nonDirectParticipants,
            'image'                 => $this->image,
        ];
    }
}

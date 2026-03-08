<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Character;
use App\Models\Location;

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
            'location_data'         => $this->location_data
                                        ? Location::find($this->location_data)
                                        : null,
            'participants'          => Character::whereIn('id', $this->participants ?? [])->get(['id', 'name', 'image']),
            'nonDirectParticipants' => Character::whereIn('id', $this->nonDirectParticipants ?? [])->get(['id', 'name', 'image']),
            'image'                 => $this->image,
        ];
    }
}

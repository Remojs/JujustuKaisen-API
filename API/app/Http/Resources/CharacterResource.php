<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Species;
use App\Models\Occupation;
use App\Models\Affiliation;
use App\Models\CursedTechnique;
use App\Models\DomainExpansion;
use App\Models\Battle;
use App\Models\CursedTool;
use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Constants\GradeConstants;
use App\Constants\TechniqueTypeConstants;
use App\Constants\TechniqueRangeConstants;

class CharacterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'alias'            => $this->alias,
            'species'          => $this->speciesId
                                    ? Species::find($this->speciesId)
                                    : null,
            'birthday'         => $this->birthday,
            'height'           => $this->height,
            'age'              => $this->age,
            'gender'           => $this->gender
                                    ? [
                                        'id'   => $this->gender,
                                        'name' => GenderEnum::fromValue($this->gender)?->label(),
                                      ]
                                    : null,
            'occupations'      => Occupation::whereIn('id', $this->occupationId ?? [])->get(['id', 'occupation_name']),
            'affiliations'     => Affiliation::whereIn('id', $this->affiliationId ?? [])->get(['id', 'affiliation_name', 'type', 'image']),
            'animeDebut'       => $this->animeDebut,
            'mangaDebut'       => $this->mangaDebut,
            'cursedTechniques' => CursedTechnique::whereIn('id', $this->cursedTechniquesIds ?? [])
                                    ->get()
                                    ->map(fn ($t) => [
                                        'id'             => $t->id,
                                        'technique_name' => $t->technique_name,
                                        'description'    => $t->description,
                                        'type'           => $t->type
                                                                ? ['id' => $t->type, 'name' => TechniqueTypeConstants::getName($t->type)]
                                                                : null,
                                        'range'          => $t->range
                                                                ? ['id' => $t->range, 'name' => TechniqueRangeConstants::getName($t->range)]
                                                                : null,
                                        'image'          => $t->image,
                                    ]),
            'grade'            => $this->gradeId
                                    ? [
                                        'id'   => $this->gradeId,
                                        'name' => GradeConstants::getName($this->gradeId),
                                      ]
                                    : null,
            'domainExpansion'  => $this->domainExpansionId
                                    ? DomainExpansion::find($this->domainExpansionId, ['id', 'name', 'description', 'image'])
                                    : null,
            'battles'          => Battle::whereIn('id', $this->battlesId ?? [])
                                    ->get(['id', 'event', 'result', 'arc', 'date', 'image']),
            'cursedTools'      => CursedTool::whereIn('id', $this->cursedToolId ?? [])->get(['id', 'name', 'type', 'description', 'image']),
            'status'           => $this->status
                                    ? [
                                        'id'   => $this->status,
                                        'name' => StatusEnum::fromValue($this->status)?->label(),
                                      ]
                                    : null,
            'relatives'        => $this->relatives,
            'image'            => $this->image,
        ];
    }
}

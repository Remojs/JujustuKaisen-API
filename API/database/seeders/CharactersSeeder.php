<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharactersSeeder extends Seeder
{
    private function scalar(mixed $value): mixed
    {
        if (is_array($value)) {
            return $value[0] ?? null;
        }
        return $value;
    }

    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/Characters.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['characters'] as $item) {
            DB::table('characters')->insert([
                'id'                  => $item['id'],
                'name'                => $item['name'],
                'alias'               => json_encode($item['alias'] ?? []),
                'speciesId'           => $this->scalar($item['speciesId'] ?? null),
                'birthday'            => $item['birthday'] ?? null,
                'height'              => $item['height'] ?? null,
                'age'                 => $item['age'] ?? null,
                'gender'              => $this->scalar($item['gender'] ?? null),
                'occupationId'        => json_encode($item['occupationId'] ?? []),
                'affiliationId'       => json_encode($item['affiliationId'] ?? []),
                'animeDebut'          => $item['animeDebut'] ?? null,
                'mangaDebut'          => $item['mangaDebut'] ?? null,
                'cursedTechniquesIds' => json_encode($item['cursedTechniquesIds'] ?? []),
                'gradeId'             => $this->scalar($item['gradeId'] ?? null),
                'domainExpansionId'   => $this->scalar($item['domainExpansionId'] ?? null),
                'battlesId'           => json_encode($item['battlesId'] ?? []),
                'cursedToolId'        => json_encode($item['cursedToolId'] ?? []),
                'status'              => $this->scalar($item['status'] ?? null),
                'relatives'           => json_encode($item['relatives'] ?? []),
                'image'               => $item['image'] ?? null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }
}

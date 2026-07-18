<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursedTechniquesSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/CursedTechniques.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['cursed_technique'] as $item) {
            DB::table('cursed_techniques')->insert([
                'id'             => $item['id'],
                'technique_name' => $item['technique_name'],
                'description'    => $item['description'] ?? null,
                'type'           => $item['type'] ?? null,
                'range'          => $item['range'] ?? null,
                'users'          => json_encode($item['users'] ?? []),
                'image'          => $item['image'] ?? null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}

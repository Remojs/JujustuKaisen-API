<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/SupportTables/Species.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['species'] as $item) {
            DB::table('species')->insert([
                'id'           => $item['id'],
                'species_name' => $item['specie_name'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}

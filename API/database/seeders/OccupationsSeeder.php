<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/SupportTables/Occupations.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['occupation'] as $item) {
            DB::table('occupations')->insert([
                'id'              => $item['id'],
                'occupation_name' => $item['occupation_name'],
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}

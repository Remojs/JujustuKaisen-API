<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArcsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/Arcs.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['Arcs'] as $item) {
            DB::table('arcs')->insert([
                'id'         => $item['id'],
                'name'       => $item['name'],
                'manga'      => $item['manga'] ?? null,
                'anime'      => json_encode($item['anime'] ?? []),
                'image'      => $item['image'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

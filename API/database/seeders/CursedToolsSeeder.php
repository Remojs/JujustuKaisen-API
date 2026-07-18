<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursedToolsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/CursedTools.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['cursedTools'] as $item) {
            DB::table('cursed_tools')->insert([
                'id'          => $item['id'],
                'name'        => $item['name'],
                'type'        => $item['type'] ?? null,
                'owners'      => json_encode($item['owners'] ?? []),
                'description' => $item['description'] ?? null,
                'image'       => $item['image'] ?? null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}

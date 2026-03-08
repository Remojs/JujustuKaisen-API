<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainExpansionsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/DomainExpansions.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['domainExpansions'] as $item) {
            DB::table('domain_expansions')->insert([
                'id'          => $item['id'],
                'name'        => $item['name'],
                'user'        => $item['user'] ?? null,
                'range'       => $item['range'] ?? null,
                'Type'        => $item['Type'] ?? null,
                'description' => $item['description'] ?? null,
                'image'       => $item['image'] ?? null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}

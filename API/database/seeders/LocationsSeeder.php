<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/Locations.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['locations'] as $item) {
            DB::table('locations')->insert([
                'id'            => $item['id'],
                'location_name' => $item['location_name'],
                'located_in'    => $item['located_in'] ?? null,
                'description'   => $item['description'] ?? null,
                'events'        => json_encode($item['events'] ?? []),
                'image'         => $item['image'] ?? null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliationsSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/Affiliations.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['affiliations'] as $item) {
            DB::table('affiliations')->insert([
                'id'               => $item['id'],
                'affiliation_name' => $item['affiliation_name'],
                'type'             => $item['type'] ?? null,
                'controlled_by'    => $item['controlled_by'] ?? null,
                'location'         => $item['location'] ?? null,
                'location_data'    => isset($item['location_data']) ? (int) $item['location_data'] : null,
                'description'      => $item['description'] ?? null,
                'image'            => $item['image'] ?? null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}

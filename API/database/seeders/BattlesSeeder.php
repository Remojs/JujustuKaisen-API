<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BattlesSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/Battles.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['battles'] as $item) {
            DB::table('battles')->insert([
                'id'                    => $item['id'],
                'event'                 => $item['event'],
                'result'                => $item['result'],
                'arc'                   => $item['arc'],
                'date'                  => $item['date'] ?? null,
                'location'              => $item['location'] ?? null,
                'location_data'         => $item['location_data'] ?? null,
                'participants'          => json_encode($item['participants'] ?? []),
                'nonDirectParticipants' => json_encode($item['nonDirectParticipants'] ?? []),
                'image'                 => $item['image'] ?? null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}

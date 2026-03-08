<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimeEpisodesSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/AnimeEpisodes.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['AnimeEpisodes'] as $item) {
            DB::table('anime_episodes')->insert([
                'id'                     => $item['id'],
                'episode_number'         => $item['episode_number'],
                'arc'                    => $item['arc'],
                'season'                 => $item['season'] ?? null,
                'title'                  => $item['title'],
                'mangachapters_adapted'  => $item['mangachapters_adapted'] ?? null,
                'air_date'               => $item['air_date'] ?? null,
                'opening_theme'          => $item['opening_theme'] ?? null,
                'ending_theme'           => $item['ending_theme'] ?? null,
                'image'                  => $item['image'] ?? null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ]);
        }
    }
}

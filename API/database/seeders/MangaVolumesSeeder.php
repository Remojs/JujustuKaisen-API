<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MangaVolumesSeeder extends Seeder
{
    public function run(): void
    {
        $path = dirname(base_path()) . '/Data/MangaVolumes.json';
        $data = json_decode(file_get_contents($path), true);

        foreach ($data['mangaVolumes'] as $item) {
            DB::table('manga_volumes')->insert([
                'id'              => $item['id'],
                'volume_number'   => $item['volume_number'],
                'volume_name'     => $item['volume_name'],
                'release_date'    => $item['release_date'] ?? null,
                'pages'           => $item['pages'] ?? null,
                'chapters'        => $item['chapters'] ?? null,
                'cover_character' => $item['cover_character'] ?? null,
                'image'           => $item['image'] ?? null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // 1. Tablas de soporte (sin dependencias)
            SpeciesSeeder::class,
            OccupationsSeeder::class,

            // 2. Entidades secundarias (sin FK hacia characters)
            AffiliationsSeeder::class,
            LocationsSeeder::class,
            CursedTechniquesSeeder::class,
            CursedToolsSeeder::class,
            DomainExpansionsSeeder::class,

            // 3. Tabla central
            CharactersSeeder::class,

            // 4. Entidades que referencian characters o locations
            BattlesSeeder::class,

            // 5. Arcos y episodios
            ArcsSeeder::class,
            AnimeEpisodesSeeder::class,

            // 6. Manga
            MangaVolumesSeeder::class,
        ]);
    }
}

<?php

namespace App\Constants;

class SpeciesConstants
{
    public const SPECIES = [
        1 => 'Human',
        2 => 'Cursed Spirit',
        3 => 'Shikigami',
        4 => 'Cursed Womb',
        5 => 'Cursed Corpse',
        6 => 'Transfigured Human',
        7 => 'Incarnate Body',
        8 => 'Vengeful Spirit',
        9 => 'Immortal'
    ];

    public static function getName(int $id): ?string
    {
        return self::SPECIES[$id] ?? null;
    }

    public static function getAll(): array
    {
        return self::SPECIES;
    }

    public static function exists(int $id): bool
    {
        return isset(self::SPECIES[$id]);
    }
}

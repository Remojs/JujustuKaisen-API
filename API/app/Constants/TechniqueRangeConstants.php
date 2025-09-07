<?php

namespace App\Constants;

class TechniqueRangeConstants
{
    public const TECHNIQUE_RANGES = [
        1 => 'Short Range',
        2 => 'Medium Range',
        3 => 'Long Range',
        4 => 'Variable Range',
        5 => 'Self'
    ];

    public static function getName(int $id): ?string
    {
        return self::TECHNIQUE_RANGES[$id] ?? null;
    }

    public static function getAll(): array
    {
        return self::TECHNIQUE_RANGES;
    }

    public static function exists(int $id): bool
    {
        return isset(self::TECHNIQUE_RANGES[$id]);
    }
}

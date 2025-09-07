<?php

namespace App\Constants;

class TechniqueTypeConstants
{
    public const TECHNIQUE_TYPES = [
        1 => 'Innate Technique',
        2 => 'Extension Technique',
        3 => 'Cursed Spirit',
        4 => 'Barrier Techniques',
        5 => 'Anti-Domain Technique',
        6 => 'Shikigami Control',
        7 => 'Inherited Techniques',
        8 => 'Shikigami Ability',
        9 => 'Taijutsu',
        10 => 'Restriction',
        11 => 'Reverse Technique',
        12 => 'New Shadow Style Technique',
        13 => 'Cursed Spirit Ability'
    ];

    public static function getName(int $id): ?string
    {
        return self::TECHNIQUE_TYPES[$id] ?? null;
    }

    public static function getAll(): array
    {
        return self::TECHNIQUE_TYPES;
    }

    public static function exists(int $id): bool
    {
        return isset(self::TECHNIQUE_TYPES[$id]);
    }
}

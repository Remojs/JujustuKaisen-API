<?php

namespace App\Constants;

class GradeConstants
{
    public const GRADES = [
        1 => 'Grade 4',
        2 => 'Grade 3',
        3 => 'Semi-Grade 2',
        4 => 'Grade 2',
        5 => 'Semi-Grade 1',
        6 => 'Grade 1',
        7 => 'Semi-Special Grade',
        8 => 'Special Grade'
    ];

    public static function getName(int $id): ?string
    {
        return self::GRADES[$id] ?? null;
    }

    public static function getAll(): array
    {
        return self::GRADES;
    }

    public static function exists(int $id): bool
    {
        return isset(self::GRADES[$id]);
    }
}

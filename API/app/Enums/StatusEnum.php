<?php

namespace App\Enums;

enum StatusEnum: int
{
    case ALIVE = 1;
    case DEAD = 2;
    case UNKNOWN = 3;

    public function label(): string
    {
        return match($this) {
            self::ALIVE => 'Alive',
            self::DEAD => 'Dead',
            self::UNKNOWN => 'Unknown',
        };
    }

    public static function fromValue(int $value): ?self
    {
        return match($value) {
            1 => self::ALIVE,
            2 => self::DEAD,
            3 => self::UNKNOWN,
            default => null,
        };
    }

    public static function getAllValues(): array
    {
        return [
            self::ALIVE->value => self::ALIVE->label(),
            self::DEAD->value => self::DEAD->label(),
            self::UNKNOWN->value => self::UNKNOWN->label(),
        ];
    }
}

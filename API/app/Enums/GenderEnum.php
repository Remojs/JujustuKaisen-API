<?php

namespace App\Enums;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;
    case GENDERLESS = 3;

    public function label(): string
    {
        return match($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::GENDERLESS => 'Genderless',
        };
    }

    public static function fromValue(int $value): ?self
    {
        return match($value) {
            1 => self::MALE,
            2 => self::FEMALE,
            3 => self::GENDERLESS,
            default => null,
        };
    }

    public static function getAllValues(): array
    {
        return [
            self::MALE->value => self::MALE->label(),
            self::FEMALE->value => self::FEMALE->label(),
            self::GENDERLESS->value => self::GENDERLESS->label(),
        ];
    }
}

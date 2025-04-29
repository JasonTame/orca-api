<?php

namespace App\Enums;

enum JobType: string
{
    case FULL_TIME = 'full_time';
    case PART_TIME = 'part_time';
    case CONTRACT = 'contract';
    case INTERNSHIP = 'internship';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function random(): string
    {
        $values = self::values();
        return $values[array_rand($values)];
    }
}

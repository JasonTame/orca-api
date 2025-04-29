<?php

namespace App\Enums;

enum JobLevel: string
{
    case ENTRY = 'entry';
    case JUNIOR = 'junior';
    case MID = 'mid';
    case SENIOR = 'senior';
    case LEAD = 'lead';
    case PRINCIPAL = 'principal';

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

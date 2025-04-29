<?php

namespace App\Enums;

enum CompanySize: string
{
    case SMALL = 'small';
    case MEDIUM = 'medium';
    case LARGE = 'large';
    case ENTERPRISE = 'enterprise';

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

<?php

namespace App\Enums;

enum TechSkillCategory: string
{
    case LANGUAGE = 'language';
    case FRAMEWORK = 'framework';
    case DATABASE = 'database';
    case TOOL = 'tool';
    case PLATFORM = 'platform';

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

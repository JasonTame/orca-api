<?php

namespace App\Enums;

enum InterviewFormat: string
{
    case IN_PERSON = 'in_person';
    case VIDEO = 'video';
    case PHONE = 'phone';
    case TAKE_HOME = 'take_home';

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

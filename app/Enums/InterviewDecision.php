<?php

namespace App\Enums;

enum InterviewDecision: string
{
    case PROCEED = 'proceed';
    case REJECT = 'reject';
    case HOLD = 'hold';

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

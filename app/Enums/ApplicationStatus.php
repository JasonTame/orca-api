<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case PENDING = 'pending';
    case REVIEWING = 'reviewing';
    case INTERVIEWING = 'interviewing';
    case OFFERED = 'offered';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

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

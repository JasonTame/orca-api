<?php

namespace App\Enums;

enum CandidateStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case HIRED = 'hired';
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

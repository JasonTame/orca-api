<?php

namespace App\Enums;

enum CandidateSource: string
{
    case LINKEDIN = 'linkedin';
    case INDEED = 'indeed';
    case REFERRAL = 'referral';
    case CAREER_SITE = 'career_site';
    case OTHER = 'other';

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

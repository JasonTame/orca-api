<?php

namespace App\Enums;

enum ReferralSource: string
{
    case COMPANY_WEBSITE = 'company_website';
    case LINKEDIN = 'linkedin';
    case INDEED = 'indeed';
    case REFERRAL = 'referral';
    case DIRECT_EMAIL = 'direct_email';

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

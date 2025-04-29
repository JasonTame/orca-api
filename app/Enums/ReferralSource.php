<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum ReferralSource: string
{
    use EnumHelpers;

    case COMPANY_WEBSITE = 'company_website';
    case LINKEDIN = 'linkedin';
    case INDEED = 'indeed';
    case REFERRAL = 'referral';
    case DIRECT_EMAIL = 'direct_email';
}

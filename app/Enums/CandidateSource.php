<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CandidateSource: string
{
    use EnumHelpers;

    case LINKEDIN = 'linkedin';
    case INDEED = 'indeed';
    case REFERRAL = 'referral';
    case CAREER_SITE = 'career_site';
    case OTHER = 'other';
}

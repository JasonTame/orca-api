<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum JobLevel: string
{
    use EnumHelpers;

    case ENTRY = 'entry';
    case JUNIOR = 'junior';
    case MID = 'mid';
    case SENIOR = 'senior';
    case LEAD = 'lead';
    case PRINCIPAL = 'principal';
}

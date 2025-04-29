<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum JobType: string
{
    use EnumHelpers;

    case FULL_TIME = 'full_time';
    case PART_TIME = 'part_time';
    case CONTRACT = 'contract';
    case INTERNSHIP = 'internship';
}

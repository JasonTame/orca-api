<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CandidateStatus: string
{
    use EnumHelpers;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case HIRED = 'hired';
    case REJECTED = 'rejected';
}

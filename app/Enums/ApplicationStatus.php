<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum ApplicationStatus: string
{
    use EnumHelpers;

    case PENDING = 'pending';
    case REVIEWING = 'reviewing';
    case INTERVIEWING = 'interviewing';
    case OFFERED = 'offered';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}

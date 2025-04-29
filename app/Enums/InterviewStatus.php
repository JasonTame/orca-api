<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum InterviewStatus: string
{
    use EnumHelpers;

    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case RESCHEDULED = 'rescheduled';
}

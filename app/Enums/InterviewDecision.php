<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum InterviewDecision: string
{
    use EnumHelpers;

    case PROCEED = 'proceed';
    case REJECT = 'reject';
    case HOLD = 'hold';
}

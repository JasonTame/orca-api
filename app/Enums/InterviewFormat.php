<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum InterviewFormat: string
{
    use EnumHelpers;

    case IN_PERSON = 'in_person';
    case VIDEO = 'video';
    case PHONE = 'phone';
    case TAKE_HOME = 'take_home';
}

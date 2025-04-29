<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum JobSkillImportance: string
{
    use EnumHelpers;

    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case CRITICAL = 'critical';
}

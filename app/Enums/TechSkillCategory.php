<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum TechSkillCategory: string
{
    use EnumHelpers;

    case LANGUAGE = 'language';
    case FRAMEWORK = 'framework';
    case DATABASE = 'database';
    case TOOL = 'tool';
    case PLATFORM = 'platform';
}

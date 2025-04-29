<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CompanySize: string
{
    use EnumHelpers;

    case SMALL = 'small';
    case MEDIUM = 'medium';
    case LARGE = 'large';
    case ENTERPRISE = 'enterprise';
}

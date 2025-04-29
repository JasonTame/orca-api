<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CompanyStatus: string
{
    use EnumHelpers;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}

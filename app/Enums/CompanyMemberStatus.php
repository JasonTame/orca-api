<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CompanyMemberStatus: string
{
    use EnumHelpers;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}

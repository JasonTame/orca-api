<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum EntityStatus: string
{
    use EnumHelpers;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}

<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum JobStatus: string
{
    use EnumHelpers;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CLOSED = 'closed';
    case ARCHIVED = 'archived';
}

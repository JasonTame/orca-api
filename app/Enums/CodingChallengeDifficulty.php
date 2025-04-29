<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CodingChallengeDifficulty: string
{
    use EnumHelpers;

    case EASY = 'easy';
    case MEDIUM = 'medium';
    case HARD = 'hard';
}

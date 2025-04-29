<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum CandidateSkillProficiency: string
{
    use EnumHelpers;

    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';
    case EXPERT = 'expert';
}

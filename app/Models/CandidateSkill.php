<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'skill_id',
        'proficiency',
        'years_experience',
    ];

    protected $casts = [
        'years_experience' => 'integer',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(TechSkill::class, 'skill_id');
    }
}

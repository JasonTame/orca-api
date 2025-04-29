<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $candidate_id
 * @property int $skill_id
 * @property string $proficiency
 * @property int $years_experience
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Candidate $candidate
 * @property-read \App\Models\TechSkill $skill
 *
 * @method static \Database\Factories\CandidateSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereYearsExperience($value)
 *
 * @mixin \Eloquent
 */
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

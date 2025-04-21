<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $job_opening_id
 * @property int $candidate_id
 * @property string|null $code_sample_url
 * @property string $status
 * @property int|null $current_stage_id
 * @property string|null $rejection_reason
 * @property string|null $notes
 * @property string|null $referral_source
 * @property \Illuminate\Support\Carbon $applied_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Candidate $candidate
 * @property-read \App\Models\CodingChallenge|null $codingChallenge
 * @property-read \App\Models\InterviewStage|null $currentStage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening $jobOpening
 *
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereAppliedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCodeSampleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCurrentStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereReferralSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_opening_id',
        'candidate_id',
        'code_sample_url',
        'status',
        'current_stage_id',
        'rejection_reason',
        'notes',
        'referral_source',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function currentStage(): BelongsTo
    {
        return $this->belongsTo(InterviewStage::class, 'current_stage_id');
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function codingChallenge(): BelongsTo
    {
        return $this->belongsTo(CodingChallenge::class);
    }
}

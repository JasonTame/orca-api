<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $application_id
 * @property int $stage_id
 * @property int $interviewer_id
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property string|null $location
 * @property string|null $meeting_url
 * @property string $status
 * @property int|null $technical_score
 * @property int|null $cultural_score
 * @property string|null $feedback
 * @property string|null $decision
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\CompanyMember $interviewer
 * @property-read \App\Models\InterviewStage $stage
 * @method static \Database\Factories\InterviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCulturalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereDecision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereInterviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereMeetingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereTechnicalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'stage_id',
        'interviewer_id',
        'scheduled_at',
        'completed_at',
        'location',
        'meeting_url',
        'status',
        'technical_score',
        'cultural_score',
        'feedback',
        'decision',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'technical_score' => 'integer',
        'cultural_score' => 'integer',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(InterviewStage::class, 'stage_id');
    }

    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(CompanyMember::class, 'interviewer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $job_opening_id
 * @property string $name
 * @property string|null $description
 * @property int $sequence
 * @property int $duration
 * @property string $format
 * @property bool $is_technical
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening $jobOpening
 * @method static \Database\Factories\InterviewStageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereIsTechnical($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InterviewStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_opening_id',
        'name',
        'description',
        'sequence',
        'duration',
        'format',
        'is_technical',
    ];

    protected $casts = [
        'sequence' => 'integer',
        'duration' => 'integer',
        'is_technical' => 'boolean',
    ];

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'stage_id');
    }
}

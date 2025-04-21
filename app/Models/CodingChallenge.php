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
 * @property string $title
 * @property string $description
 * @property string $instructions
 * @property string $repository_url
 * @property int $time_limit
 * @property string $difficulty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\JobOpening $jobOpening
 * @method static \Database\Factories\CodingChallengeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereRepositoryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereTimeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CodingChallenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_opening_id',
        'title',
        'description',
        'instructions',
        'repository_url',
        'time_limit',
        'difficulty',
    ];

    protected $casts = [
        'time_limit' => 'integer',
    ];

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}

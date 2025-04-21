<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $company_id
 * @property string $title
 * @property string $description
 * @property string|null $team
 * @property string|null $location
 * @property string $type
 * @property string $level
 * @property numeric|null $salary_min
 * @property numeric|null $salary_max
 * @property string|null $requirements
 * @property string|null $benefits
 * @property int|null $hiring_manager_id
 * @property string $status
 * @property bool $is_remote
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $closing_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CodingChallenge> $codingChallenges
 * @property-read int|null $coding_challenges_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\CompanyMember|null $hiringManager
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InterviewStage> $interviewStages
 * @property-read int|null $interview_stages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobSkill> $jobSkills
 * @property-read int|null $job_skills_count
 *
 * @method static \Database\Factories\JobOpeningFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereHiringManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereIsRemote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereSalaryMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereSalaryMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobOpening extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'team',
        'location',
        'type',
        'level',
        'salary_min',
        'salary_max',
        'requirements',
        'benefits',
        'hiring_manager_id',
        'status',
        'is_remote',
        'published_at',
        'closing_date',
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'published_at' => 'datetime',
        'closing_date' => 'datetime',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function hiringManager(): BelongsTo
    {
        return $this->belongsTo(CompanyMember::class, 'hiring_manager_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function jobSkills(): HasMany
    {
        return $this->hasMany(JobSkill::class);
    }

    public function interviewStages(): HasMany
    {
        return $this->hasMany(InterviewStage::class);
    }

    public function codingChallenges(): HasMany
    {
        return $this->hasMany(CodingChallenge::class);
    }
}

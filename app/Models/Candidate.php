<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $location
 * @property string|null $resume_url
 * @property string|null $portfolio_url
 * @property string|null $linkedin_url
 * @property int|null $years_experience
 * @property string|null $current_position
 * @property string|null $current_company
 * @property numeric|null $desired_salary
 * @property string $source
 * @property string|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CandidateSkill> $skills
 * @property-read int|null $skills_count
 *
 * @method static \Database\Factories\CandidateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCurrentCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCurrentPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereDesiredSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate wherePortfolioUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereResumeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereYearsExperience($value)
 *
 * @mixin \Eloquent
 */
class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'location',
        'resume_url',
        'portfolio_url',
        'linkedin_url',
        'years_experience',
        'current_position',
        'current_company',
        'desired_salary',
        'source',
        'notes',
        'status',
    ];

    protected $casts = [
        'years_experience' => 'integer',
        'desired_salary' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function skills()
    {
        return $this->hasMany(CandidateSkill::class);
    }
}

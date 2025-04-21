<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

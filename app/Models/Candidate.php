<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

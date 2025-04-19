<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

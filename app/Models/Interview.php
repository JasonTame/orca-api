<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(User::class, 'interviewer_id');
    }
}

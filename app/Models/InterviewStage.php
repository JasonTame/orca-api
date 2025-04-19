<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

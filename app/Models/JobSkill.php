<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_opening_id',
        'skill_id',
        'is_required',
        'importance',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(TechSkill::class, 'skill_id');
    }
}

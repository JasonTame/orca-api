<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

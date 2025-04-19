<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'is_language',
        'is_framework',
        'is_tool',
        'parent_skill_id',
    ];

    protected $casts = [
        'is_language' => 'boolean',
        'is_framework' => 'boolean',
        'is_tool' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(TechSkill::class, 'parent_skill_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(TechSkill::class, 'parent_skill_id');
    }

    public function jobSkills(): HasMany
    {
        return $this->hasMany(JobSkill::class, 'skill_id');
    }

    public function candidateSkills(): HasMany
    {
        return $this->hasMany(CandidateSkill::class, 'skill_id');
    }
}

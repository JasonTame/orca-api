<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $category
 * @property bool $is_language
 * @property bool $is_framework
 * @property bool $is_tool
 * @property int|null $parent_skill_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CandidateSkill> $candidateSkills
 * @property-read int|null $candidate_skills_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, TechSkill> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobSkill> $jobSkills
 * @property-read int|null $job_skills_count
 * @property-read TechSkill|null $parent
 *
 * @method static \Database\Factories\TechSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsFramework($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsTool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereParentSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
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

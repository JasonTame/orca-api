<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $job_opening_id
 * @property int $skill_id
 * @property bool $is_required
 * @property string $importance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JobOpening $jobOpening
 * @property-read \App\Models\TechSkill $skill
 *
 * @method static \Database\Factories\JobSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereImportance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
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

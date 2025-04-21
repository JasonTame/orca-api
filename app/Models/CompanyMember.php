<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $email
 * @property string|null $position
 * @property string|null $department
 * @property string|null $phone
 * @property bool $is_hiring_manager
 * @property bool $is_recruiter
 * @property bool $is_interviewer
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobOpening> $jobOpenings
 * @property-read int|null $job_openings_count
 *
 * @method static \Database\Factories\CompanyMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsHiringManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsInterviewer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsRecruiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CompanyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'position',
        'department',
        'phone',
        'is_hiring_manager',
        'is_recruiter',
        'is_interviewer',
        'status',
    ];

    protected $casts = [
        'is_hiring_manager' => 'boolean',
        'is_recruiter' => 'boolean',
        'is_interviewer' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function jobOpenings(): HasMany
    {
        return $this->hasMany(JobOpening::class, 'hiring_manager_id');
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'interviewer_id');
    }
}

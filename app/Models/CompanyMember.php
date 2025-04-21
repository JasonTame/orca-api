<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

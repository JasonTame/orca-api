<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_url',
        'website',
        'industry',
        'size',
        'description',
        'location',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(CompanyMember::class);
    }

    public function jobOpenings(): HasMany
    {
        return $this->hasMany(JobOpening::class);
    }
}

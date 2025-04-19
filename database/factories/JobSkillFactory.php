<?php

namespace Database\Factories;

use App\Models\JobOpening;
use App\Models\JobSkill;
use App\Models\TechSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobSkillFactory extends Factory
{
    protected $model = JobSkill::class;

    public function definition(): array
    {
        return [
            'job_opening_id' => JobOpening::factory(),
            'skill_id' => TechSkill::factory(),
            'is_required' => $this->faker->boolean(),
            'importance' => $this->faker->randomElement(['low', 'medium', 'high', 'critical']),
        ];
    }
}

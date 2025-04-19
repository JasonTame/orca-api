<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\TechSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateSkillFactory extends Factory
{
    protected $model = CandidateSkill::class;

    public function definition(): array
    {
        return [
            'candidate_id' => Candidate::factory(),
            'skill_id' => TechSkill::factory(),
            'proficiency' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),
            'years_experience' => $this->faker->numberBetween(0, 20),
        ];
    }
}

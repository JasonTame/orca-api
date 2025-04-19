<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'job_opening_id' => JobOpening::factory(),
            'candidate_id' => Candidate::factory(),
            'code_sample_url' => $this->faker->optional()->url(),
            'status' => $this->faker->randomElement(['pending', 'reviewing', 'interviewing', 'offered', 'accepted', 'rejected']),
            'current_stage_id' => InterviewStage::factory(),
            'rejection_reason' => $this->faker->optional()->sentence(),
            'notes' => $this->faker->optional()->paragraph(),
            'referral_source' => $this->faker->optional()->word(),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

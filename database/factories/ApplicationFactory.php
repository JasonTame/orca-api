<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Enums\ReferralSource;
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
            'status' => ApplicationStatus::random(),
            'current_stage_id' => InterviewStage::factory(),
            'rejection_reason' => $this->faker->optional()->sentence(),
            'notes' => $this->faker->optional()->paragraph(),
            'referral_source' => ReferralSource::random(),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

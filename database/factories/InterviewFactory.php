<?php

namespace Database\Factories;

use App\Enums\InterviewDecision;
use App\Enums\InterviewStatus;
use App\Models\Application;
use App\Models\CompanyMember;
use App\Models\Interview;
use App\Models\InterviewStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition(): array
    {
        return [
            'application_id' => Application::factory(),
            'stage_id' => InterviewStage::factory(),
            'interviewer_id' => CompanyMember::factory(),
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'completed_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'location' => $this->faker->optional()->city(),
            'meeting_url' => $this->faker->optional()->url(),
            'status' => InterviewStatus::random(),
            'technical_score' => $this->faker->optional()->numberBetween(1, 5),
            'cultural_score' => $this->faker->optional()->numberBetween(1, 5),
            'feedback' => $this->faker->optional()->paragraph(),
            'decision' => $this->faker->optional()->randomElement([InterviewDecision::PROCEED, InterviewDecision::REJECT, InterviewDecision::HOLD]),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}

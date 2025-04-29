<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Enums\ReferralSource;
use App\Enums\CandidateSource;
use App\Enums\CandidateStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->city(),
            'resume_url' => $this->faker->url(),
            'portfolio_url' => $this->faker->url(),
            'linkedin_url' => $this->faker->url(),
            'years_experience' => $this->faker->numberBetween(0, 20),
            'current_position' => $this->faker->randomElement([
                'Frontend Developer',
                'Backend Developer',
                'Fullstack Developer',
                'Mobile Developer',
                'DevOps Engineer',
                'Data Scientist',
                'Database Administrator',
                'QA Engineer',
            ]),
            'current_company' => $this->faker->company(),
            'desired_salary' => $this->faker->numberBetween(50000, 200000),
            'source' => CandidateSource::random(),
            'notes' => $this->faker->paragraph(),
            'status' => CandidateStatus::random(),
        ];
    }
}

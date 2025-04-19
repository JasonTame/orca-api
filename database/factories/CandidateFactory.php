<?php

namespace Database\Factories;

use App\Models\Candidate;
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
            'current_position' => $this->faker->jobTitle(),
            'current_company' => $this->faker->company(),
            'desired_salary' => $this->faker->numberBetween(50000, 200000),
            'source' => $this->faker->randomElement(['linkedin', 'indeed', 'referral', 'career_site', 'other']),
            'notes' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'hired', 'rejected']),
        ];
    }
}

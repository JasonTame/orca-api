<?php

namespace Database\Factories;

use App\Models\JobOpening;
use App\Models\CodingChallenge;
use App\Enums\CodingChallengeDifficulty;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodingChallengeFactory extends Factory
{
    protected $model = CodingChallenge::class;

    public function definition(): array
    {
        return [
            'job_opening_id' => JobOpening::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'instructions' => $this->faker->paragraphs(3, true),
            'repository_url' => $this->faker->url(),
            'time_limit' => $this->faker->numberBetween(30, 180),
            'difficulty' => CodingChallengeDifficulty::random(),
        ];
    }
}

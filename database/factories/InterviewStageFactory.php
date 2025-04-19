<?php

namespace Database\Factories;

use App\Models\InterviewStage;
use App\Models\JobOpening;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewStageFactory extends Factory
{
    protected $model = InterviewStage::class;

    public function definition(): array
    {
        return [
            'job_opening_id' => JobOpening::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'sequence' => $this->faker->numberBetween(1, 5),
            'duration' => $this->faker->numberBetween(30, 120),
            'format' => $this->faker->randomElement(['in_person', 'video', 'phone']),
            'is_technical' => $this->faker->boolean(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\TechSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechSkillFactory extends Factory
{
    protected $model = TechSkill::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'category' => $this->faker->randomElement(['language', 'framework', 'database', 'tool', 'platform']),
            'parent_skill_id' => null, // Can be set manually when needed
        ];
    }

    public function language(): self
    {
        return $this->state(function () {
            return [
                'category' => 'language',
            ];
        });
    }

    public function framework(): self
    {
        return $this->state(function () {
            return [
                'category' => 'framework',
            ];
        });
    }

    public function tool(): self
    {
        return $this->state(function () {
            return [
                'category' => 'tool',
            ];
        });
    }
}

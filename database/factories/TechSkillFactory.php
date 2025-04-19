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
            'is_language' => function (array $attributes) {
                return $attributes['category'] === 'language';
            },
            'is_framework' => function (array $attributes) {
                return $attributes['category'] === 'framework';
            },
            'is_tool' => function (array $attributes) {
                return $attributes['category'] === 'tool';
            },
            'parent_skill_id' => null, // Can be set manually when needed
        ];
    }

    public function language(): self
    {
        return $this->state(function () {
            return [
                'category' => 'language',
                'is_language' => true,
                'is_framework' => false,
                'is_tool' => false,
            ];
        });
    }

    public function framework(): self
    {
        return $this->state(function () {
            return [
                'category' => 'framework',
                'is_language' => false,
                'is_framework' => true,
                'is_tool' => false,
            ];
        });
    }

    public function tool(): self
    {
        return $this->state(function () {
            return [
                'category' => 'tool',
                'is_language' => false,
                'is_framework' => false,
                'is_tool' => true,
            ];
        });
    }
}

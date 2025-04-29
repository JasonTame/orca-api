<?php

namespace Database\Factories;

use App\Models\TechSkill;
use App\Enums\TechSkillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechSkillFactory extends Factory
{
    protected $model = TechSkill::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'category' => TechSkillCategory::random(),
            'parent_skill_id' => null,
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

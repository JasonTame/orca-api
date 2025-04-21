<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyMember>
 */
class CompanyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->jobTitle(),
            'department' => fake()->randomElement(['Engineering', 'HR', 'Product', 'Marketing', 'Sales']),
            'phone' => fake()->phoneNumber(),
            'is_hiring_manager' => fake()->boolean(),
            'is_recruiter' => fake()->boolean(),
            'is_interviewer' => fake()->boolean(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}

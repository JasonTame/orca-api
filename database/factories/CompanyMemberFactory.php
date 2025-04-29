<?php

namespace Database\Factories;

use App\Enums\CompanyMemberStatus;
use App\Models\Company;
use App\Models\CompanyMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyMember>
 */
class CompanyMemberFactory extends Factory
{
    protected $model = CompanyMember::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->jobTitle(),
            'department' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'is_hiring_manager' => $this->faker->boolean(),
            'is_recruiter' => $this->faker->boolean(),
            'is_interviewer' => $this->faker->boolean(),
            'status' => CompanyMemberStatus::random(),
        ];
    }
}

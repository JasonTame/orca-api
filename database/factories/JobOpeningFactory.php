<?php

namespace Database\Factories;

use App\Enums\JobLevel;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Models\Company;
use App\Models\CompanyMember;
use App\Models\JobOpening;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOpeningFactory extends Factory
{
    protected $model = JobOpening::class;

    public function definition(): array
    {
        $company = Company::factory()->create();
        $companyMember = CompanyMember::factory()->create([
            'company_id' => $company->id,
        ]);

        return [
            'company_id' => $company->id,
            'title' => fake()->randomElement([
                'Frontend Developer',
                'Backend Developer',
                'Fullstack Developer',
                'Mobile Developer',
                'DevOps Engineer',
                'Data Scientist',
                'Database Administrator',
                'QA Engineer',
            ]),
            'description' => fake()->paragraphs(3, true),
            'team' => fake()->word(),
            'location' => fake()->city(),
            'type' => JobType::random(),
            'level' => JobLevel::random(),
            'salary_min' => fake()->numberBetween(50000, 100000),
            'salary_max' => fake()->numberBetween(100000, 200000),
            'requirements' => fake()->paragraphs(2, true),
            'benefits' => fake()->paragraphs(2, true),
            'hiring_manager_id' => $companyMember->id,
            'status' => JobStatus::random(),
            'is_remote' => fake()->boolean(),
            'published_at' => fake()->optional()->dateTime(),
            'closing_date' => fake()->optional()->dateTime(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyMember;
use App\Models\JobOpening;
use App\Models\JobSkill;
use App\Models\TechSkill;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $techSkills = TechSkill::all();

        foreach ($companies as $company) {
            $hiringManager = CompanyMember::where('company_id', $company->id)
                ->where('is_hiring_manager', true)
                ->first();
            $numberOfJobs = rand(0, 2);

            JobOpening::factory()
                ->count($numberOfJobs)
                ->create([
                    'company_id' => $company->id,
                    'hiring_manager_id' => $hiringManager->id,
                ])
                ->each(function ($jobOpening) use ($techSkills) {
                    $numberOfSkills = rand(1, 3);
                    $selectedSkills = $techSkills->random($numberOfSkills);

                    foreach ($selectedSkills as $skill) {
                        JobSkill::factory()->create([
                            'job_opening_id' => $jobOpening->id,
                            'skill_id' => $skill->id,
                            'is_required' => rand(0, 1) === 1,
                            'importance' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
                        ]);
                    }
                });
        }
    }
}

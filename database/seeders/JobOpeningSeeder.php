<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $numberOfJobs = rand(0, 2);

            JobOpening::factory()
                ->count($numberOfJobs)
                ->create([
                    'company_id' => $company->id,
                ]);
        }
    }
}

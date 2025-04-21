<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyMember;
use Illuminate\Database\Seeder;

class CompanyMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $numberOfMembers = rand(1, 3);

            CompanyMember::factory()->count($numberOfMembers)->create([
                'company_id' => $company->id,
                'is_hiring_manager' => true,
            ]);
        }
    }
}

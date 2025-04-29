<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TechSkillSeeder::class,
            CompanySeeder::class,
            CompanyMemberSeeder::class,
            CandidateSeeder::class,
            JobOpeningSeeder::class,
            InterviewStageSeeder::class,
            CodingChallengeSeeder::class,
            ApplicationSeeder::class,
            InterviewSeeder::class,
        ]);
    }
}

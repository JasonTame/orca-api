<?php

namespace Database\Seeders;

use App\Enums\CandidateSkillProficiency;
use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\TechSkill;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techSkills = TechSkill::all();

        Candidate::factory()
            ->count(20)
            ->create()
            ->each(function ($candidate) use ($techSkills) {
                $numberOfSkills = rand(1, 3);
                $selectedSkills = $techSkills->random($numberOfSkills);

                foreach ($selectedSkills as $skill) {
                    CandidateSkill::factory()->create([
                        'candidate_id' => $candidate->id,
                        'skill_id' => $skill->id,
                        'proficiency' => CandidateSkillProficiency::random(),
                        'years_experience' => fake()->numberBetween(0, 20),
                    ]);
                }
            });
    }
}

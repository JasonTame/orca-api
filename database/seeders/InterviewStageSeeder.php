<?php

namespace Database\Seeders;

use App\Enums\InterviewFormat;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class InterviewStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobOpenings = JobOpening::all();

        foreach ($jobOpenings as $jobOpening) {
            $stages = [
                [
                    'name' => 'Initial Screening',
                    'description' => 'Brief phone call to assess basic qualifications and fit',
                    'sequence' => 1,
                    'duration' => 30,
                    'format' => InterviewFormat::PHONE->value,
                    'is_technical' => false,
                ],
                [
                    'name' => 'Technical Assessment',
                    'description' => 'Assessment of technical skills through coding challenges or technical questions',
                    'sequence' => 2,
                    'duration' => 60,
                    'format' => InterviewFormat::VIDEO->value,
                    'is_technical' => true,
                ],
                [
                    'name' => 'Technical Interview',
                    'description' => 'In-depth technical interview with team members',
                    'sequence' => 3,
                    'duration' => 90,
                    'format' => InterviewFormat::VIDEO->value,
                    'is_technical' => true,
                ],
                [
                    'name' => 'Cultural Fit Interview',
                    'description' => 'Interview to assess cultural fit with the team and company',
                    'sequence' => 4,
                    'duration' => 60,
                    'format' => InterviewFormat::VIDEO->value,
                    'is_technical' => false,
                ],
                [
                    'name' => 'Final Interview',
                    'description' => 'Final interview with senior management or executives',
                    'sequence' => 5,
                    'duration' => 60,
                    'format' => InterviewFormat::IN_PERSON->value,
                    'is_technical' => false,
                ],
            ];

            foreach ($stages as $stage) {
                InterviewStage::create([
                    'job_opening_id' => $jobOpening->id,
                    'name' => $stage['name'],
                    'description' => $stage['description'],
                    'sequence' => $stage['sequence'],
                    'duration' => $stage['duration'],
                    'format' => $stage['format'],
                    'is_technical' => $stage['is_technical'],
                ]);
            }
        }
    }
}

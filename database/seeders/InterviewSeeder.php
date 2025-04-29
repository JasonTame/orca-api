<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Enums\InterviewDecision;
use App\Enums\InterviewFormat;
use App\Enums\InterviewStatus;
use App\Models\Application;
use App\Models\CompanyMember;
use App\Models\Interview;
use App\Models\InterviewStage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get only applications that are in interviewing status or further
        $applications = Application::whereIn('status', [
            ApplicationStatus::REVIEWING->value,
            ApplicationStatus::INTERVIEWING->value,
            ApplicationStatus::OFFERED->value,
            ApplicationStatus::ACCEPTED->value
        ])->get();

        $interviewers = CompanyMember::where('is_interviewer', true)->get();

        if ($interviewers->isEmpty()) {
            echo "No interviewers found. Please make sure there are company members with is_interviewer set to true.\n";
            return;
        }

        foreach ($applications as $application) {
            // Get all stages for this job opening
            $stages = InterviewStage::where('job_opening_id', $application->job_opening_id)
                ->orderBy('sequence', 'asc')
                ->get();

            if ($stages->isEmpty()) {
                continue; // Skip if no stages exist for this job opening
            }

            // Determine how many interviews to create based on application status
            $maxStageIndex = match ($application->status) {
                ApplicationStatus::REVIEWING->value => 0, // Only first stage
                ApplicationStatus::INTERVIEWING->value => rand(1, count($stages) - 2), // Some middle stages
                ApplicationStatus::OFFERED->value, ApplicationStatus::ACCEPTED->value => count($stages) - 1, // All stages
                default => 0
            };

            // Create interviews for stages up to maxStageIndex
            for ($i = 0; $i <= $maxStageIndex; $i++) {
                if ($i >= count($stages)) {
                    continue;
                }

                $stage = $stages[$i];
                $interviewer = $interviewers->random();

                // Calculate dates
                $scheduledDate = Carbon::now()->subDays(30 - $i * 5)->addHours(rand(9, 16));

                // Determine status based on stage sequence
                $status = $i < $maxStageIndex
                    ? InterviewStatus::COMPLETED->value
                    : InterviewStatus::random();

                $interview = [
                    'application_id' => $application->id,
                    'stage_id' => $stage->id,
                    'interviewer_id' => $interviewer->id,
                    'scheduled_at' => $scheduledDate,
                    'completed_at' => $status === InterviewStatus::COMPLETED->value ? $scheduledDate->copy()->addHours(1) : null,
                    'location' => $stage->format === InterviewFormat::IN_PERSON->value ? 'Company HQ, Room ' . rand(100, 500) : null,
                    'meeting_url' => $stage->format === InterviewFormat::VIDEO->value ? 'https://meet.company.com/' . Str::random(10) : null,
                    'status' => $status,
                    'technical_score' => $status === InterviewStatus::COMPLETED->value && $stage->is_technical ? rand(1, 10) : null,
                    'cultural_score' => $status === InterviewStatus::COMPLETED->value && !$stage->is_technical ? rand(1, 10) : null,
                    'feedback' => $status === InterviewStatus::COMPLETED->value ? $this->getRandomFeedback($stage->is_technical) : null,
                    'decision' => $status === InterviewStatus::COMPLETED->value ? InterviewDecision::random() : null,
                    'notes' => $this->getRandomNotes(),
                ];

                try {
                    Interview::create($interview);
                } catch (\Exception $e) {
                    // Skip if there's a unique constraint violation
                    continue;
                }
            }
        }
    }

    private function getRandomFeedback(bool $isTechnical): string
    {
        if ($isTechnical) {
            $feedback = [
                'Strong problem-solving skills. Could improve code organization.',
                'Good technical knowledge but needs more experience with our stack.',
                'Excellent coding skills and system design understanding.',
                'Struggles with complex algorithms but good practical coding skills.',
                'Strong in backend development, less experienced with frontend.',
                'Great understanding of data structures and algorithms.',
                'Solid fundamentals but needs to work on optimization techniques.',
                'Impressive knowledge of our tech stack and architecture patterns.',
            ];
        } else {
            $feedback = [
                'Great communication skills and teamwork attitude.',
                'Seems enthusiastic about our company mission and values.',
                'Good cultural fit, aligns well with our team dynamics.',
                'Communicates clearly but could improve listening skills.',
                'Shows leadership potential and takes initiative.',
                'Adaptable and open to feedback, eager to learn.',
                'Professional demeanor and good interpersonal skills.',
                'Strong problem-solving approach and critical thinking.',
            ];
        }

        return $feedback[array_rand($feedback)];
    }

    private function getRandomNotes(): string
    {
        $notes = [
            'Candidate was well-prepared and asked insightful questions.',
            'Responded well under pressure during technical challenges.',
            'Showed genuine interest in the role and our company.',
            'Has relevant experience that could benefit our team.',
            'Consider for future opportunities if not selected for this role.',
            'Might be better suited for a different team/position.',
            'Demonstrated strong analytical thinking and attention to detail.',
            'Arrived late but handled the interview professionally.',
            'Would work well with our existing team members.',
            'Strong portfolio of previous work.',
        ];

        return $notes[array_rand($notes)];
    }
}

<?php

namespace Database\Seeders;

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
        $applications = Application::whereIn('status', ['screening', 'interviewing', 'offer', 'hired'])->get();
        $interviewers = CompanyMember::where('is_interviewer', true)->get();

        if ($interviewers->isEmpty()) {
            echo "No interviewers found. Please make sure there are company members with is_interviewer set to true.\n";
            return;
        }

        $statuses = ['scheduled', 'completed', 'cancelled', 'rescheduled'];
        $decisions = ['proceed', 'reject', 'hold'];

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
                'screening' => 0, // Only first stage
                'interviewing' => rand(1, count($stages) - 2), // Some middle stages
                'offer', 'hired' => count($stages) - 1, // All stages
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
                $status = $i < $maxStageIndex ? 'completed' : $statuses[array_rand($statuses)];

                $interview = [
                    'application_id' => $application->id,
                    'stage_id' => $stage->id,
                    'interviewer_id' => $interviewer->id,
                    'scheduled_at' => $scheduledDate,
                    'completed_at' => $status === 'completed' ? $scheduledDate->copy()->addHours(1) : null,
                    'location' => $stage->format === 'in_person' ? 'Company HQ, Room ' . rand(100, 500) : null,
                    'meeting_url' => $stage->format === 'video' ? 'https://meet.company.com/' . Str::random(10) : null,
                    'status' => $status,
                    'technical_score' => $status === 'completed' && $stage->is_technical ? rand(1, 10) : null,
                    'cultural_score' => $status === 'completed' && !$stage->is_technical ? rand(1, 10) : null,
                    'feedback' => $status === 'completed' ? $this->getRandomFeedback($stage->is_technical) : null,
                    'decision' => $status === 'completed' ? $decisions[array_rand($decisions)] : null,
                    'notes' => $this->getRandomNotes(),
                ];

                Interview::create($interview);
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

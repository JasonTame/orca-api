<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobOpenings = JobOpening::all();
        $candidates = Candidate::all();

        $statuses = ['pending', 'reviewing', 'interviewing', 'offered', 'accepted', 'rejected'];
        $sources = ['company_website', 'linkedin', 'indeed', 'referral', 'direct_email'];

        // Keep track of created combinations to avoid duplicates
        $usedCombinations = [];

        $count = 0;
        $maxAttempts = 100; // Prevent infinite loop
        $attempts = 0;

        while ($count < 50 && $attempts < $maxAttempts) {
            $attempts++;

            $jobOpening = $jobOpenings->random();
            $candidate = $candidates->random();

            $key = $jobOpening->id . '-' . $candidate->id;
            if (in_array($key, $usedCombinations)) {
                continue;
            }
            $firstStage = InterviewStage::where('job_opening_id', $jobOpening->id)
                ->orderBy('sequence', 'asc')
                ->first();

            if (!$firstStage) {
                continue;
            }

            $usedCombinations[] = $key;

            $status = $statuses[array_rand($statuses)];
            $source = $sources[array_rand($sources)];

            $appliedDate = Carbon::now()->subDays(rand(1, 60));

            Application::create([
                'job_opening_id' => $jobOpening->id,
                'candidate_id' => $candidate->id,
                'code_sample_url' => rand(0, 1) ? 'https://github.com/' . $candidate->first_name . $candidate->last_name . '/code-sample' : null,
                'status' => $status,
                'current_stage_id' => $firstStage->id,
                'rejection_reason' => $status === 'rejected' ? $this->getRandomRejectionReason() : null,
                'notes' => $this->getRandomNotes(),
                'referral_source' => $source,
                'applied_at' => $appliedDate,
            ]);

            $count++;
        }

        if ($count < 50) {
            echo "Created $count applications (limited by unique job opening + candidate combinations)\n";
        }
    }

    private function getRandomRejectionReason(): string
    {
        $reasons = [
            'Insufficient technical skills',
            'Not enough experience',
            'Better qualified candidates found',
            'Salary expectations too high',
            'Poor cultural fit',
            'Failed technical assessment',
            'Position filled internally',
            'Position put on hold',
        ];

        return $reasons[array_rand($reasons)];
    }

    private function getRandomNotes(): string
    {
        $notes = [
            'Strong technical background',
            'Great communication skills',
            'Needs more experience with our tech stack',
            'Potential for growth',
            'Consider for other positions',
            'Impressive portfolio',
            'Good attitude but lacks specific skills',
            'Enthusiastic about our company mission',
            'Previous experience in similar role',
            'Willing to relocate',
        ];

        return $notes[array_rand($notes)];
    }
}

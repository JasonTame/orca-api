<?php

namespace Database\Seeders;

use App\Enums\CodingChallengeDifficulty;
use App\Models\CodingChallenge;
use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class CodingChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $jobOpenings = JobOpening::all();

        if ($jobOpenings->isEmpty()) {
            $this->command->info('No job openings found. Please run JobOpeningSeeder first.');

            return;
        }

        $challenges = [
            [
                'title' => 'REST API Implementation',
                'description' => 'Implement a RESTful API for a simple task management system',
                'instructions' => 'Create a REST API with the following endpoints:
1. GET /tasks - List all tasks
2. POST /tasks - Create a new task
3. GET /tasks/{id} - Get a specific task
4. PUT /tasks/{id} - Update a task
5. DELETE /tasks/{id} - Delete a task

Requirements:
- Use Laravel
- Implement proper validation
- Add authentication
- Write tests
- Document the API',
                'repository_url' => 'https://github.com/example/task-api',
                'time_limit' => 120,
                'difficulty' => CodingChallengeDifficulty::MEDIUM,
            ],
            [
                'title' => 'Frontend Dashboard',
                'description' => 'Create a responsive dashboard using React',
                'instructions' => 'Build a dashboard with the following features:
1. User authentication
2. Data visualization charts
3. Responsive design
4. Dark/light mode toggle
5. Real-time updates

Requirements:
- Use React with TypeScript
- Implement proper state management
- Add unit tests
- Follow accessibility guidelines
- Optimize performance',
                'repository_url' => 'https://github.com/example/dashboard',
                'time_limit' => 180,
                'difficulty' => CodingChallengeDifficulty::HARD,
            ],
            [
                'title' => 'Database Optimization',
                'description' => 'Optimize database queries for a high-traffic application',
                'instructions' => 'Given a set of slow queries, optimize them by:
1. Adding appropriate indexes
2. Rewriting queries for better performance
3. Implementing caching where appropriate
4. Analyzing query execution plans
5. Documenting the changes

Requirements:
- Use PostgreSQL
- Provide before/after performance metrics
- Explain the optimization strategy
- Consider edge cases
- Ensure data consistency',
                'repository_url' => 'https://github.com/example/db-optimization',
                'time_limit' => 90,
                'difficulty' => CodingChallengeDifficulty::MEDIUM,
            ],
        ];

        foreach ($challenges as $challenge) {
            CodingChallenge::create([
                ...$challenge,
                'job_opening_id' => $jobOpenings->random()->id,
            ]);
        }
    }
}

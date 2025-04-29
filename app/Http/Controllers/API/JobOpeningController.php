<?php

namespace App\Http\Controllers\API;

use App\Enums\JobLevel;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Job Openings
 */
class JobOpeningController extends Controller
{
    #[Endpoint('List all job openings')]
    public function index(): JsonResponse
    {
        $jobOpenings = JobOpening::with(['company', 'hiringManager', 'applications'])->get();

        return response()->json($jobOpenings);
    }

    #[Endpoint('Create a new job opening')]
    #[BodyParam('company_id', 'integer', 'The ID of the company', required: true, example: 1)]
    #[BodyParam('hiring_manager_id', 'integer', 'The ID of the hiring manager', required: true, example: 1)]
    #[BodyParam('title', 'string', 'Job title', required: true, example: 'Senior Software Engineer')]
    #[BodyParam('description', 'string', 'Detailed job description', required: true, example: 'We are looking for an experienced software engineer to join our team...')]
    #[BodyParam('team', 'string', 'Team or department', required: false, example: 'Engineering')]
    #[BodyParam('location', 'string', 'Job location', required: false, example: 'San Francisco, CA')]
    #[BodyParam('type', 'string', 'Employment type', required: true, enum: JobType::class, example: 'full_time')]
    #[BodyParam('level', 'string', 'Experience level', required: true, enum: JobLevel::class, example: 'senior')]
    #[BodyParam('salary_min', 'number', 'Minimum salary', required: false, example: 120000)]
    #[BodyParam('salary_max', 'number', 'Maximum salary', required: false, example: 160000)]
    #[BodyParam('requirements', 'string', 'Job requirements', required: false, example: "- 5+ years of experience with web development\n- Strong knowledge of JavaScript and React\n- Experience with Node.js")]
    #[BodyParam('benefits', 'string', 'Job benefits', required: false, example: "- Health, dental, and vision insurance\n- 401(k) matching\n- Generous PTO")]
    #[BodyParam('status', 'string', 'Job posting status', required: true, enum: JobStatus::class, example: 'published')]
    #[BodyParam('is_remote', 'boolean', 'Whether the job is remote', required: false, example: true)]
    #[BodyParam('published_at', 'string', 'When the job was published', required: false, example: '2023-05-01T00:00:00Z')]
    #[BodyParam('closing_date', 'string', 'When the job posting closes', required: false, example: '2023-06-01T00:00:00Z')]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'hiring_manager_id' => 'required|exists:company_members,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:'.implode(',', JobType::values()),
            'level' => 'required|in:'.implode(',', JobLevel::values()),
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:'.implode(',', JobStatus::values()),
            'is_remote' => 'boolean',
            'published_at' => 'nullable|date',
            'closing_date' => 'nullable|date|after:published_at',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jobOpening = JobOpening::create($request->all());

        return response()->json($jobOpening, 201);
    }

    #[Endpoint('Get a single job opening')]
    public function show(JobOpening $jobOpening): JsonResponse
    {
        $jobOpening->load(['company', 'hiringManager', 'applications']);

        return response()->json($jobOpening);
    }

    #[Endpoint('Update a job opening')]
    #[BodyParam('company_id', 'integer', 'The ID of the company', required: false, example: 1)]
    #[BodyParam('hiring_manager_id', 'integer', 'The ID of the hiring manager', required: false, example: 2)]
    #[BodyParam('title', 'string', 'Job title', required: false, example: 'Lead Software Engineer')]
    #[BodyParam('description', 'string', 'Detailed job description', required: false, example: 'Updated job description with additional responsibilities...')]
    #[BodyParam('team', 'string', 'Team or department', required: false, example: 'Platform Engineering')]
    #[BodyParam('location', 'string', 'Job location', required: false, example: 'Remote')]
    #[BodyParam('type', 'string', 'Employment type', required: false, enum: JobType::class, example: 'full_time')]
    #[BodyParam('level', 'string', 'Experience level', required: false, enum: JobLevel::class, example: 'lead')]
    #[BodyParam('salary_min', 'number', 'Minimum salary', required: false, example: 150000)]
    #[BodyParam('salary_max', 'number', 'Maximum salary', required: false, example: 180000)]
    #[BodyParam('requirements', 'string', 'Job requirements', required: false, example: "- 8+ years of experience with web development\n- Strong knowledge of system architecture\n- Team leadership experience")]
    #[BodyParam('benefits', 'string', 'Job benefits', required: false, example: "- Updated benefits package\n- Home office stipend\n- Learning budget")]
    #[BodyParam('status', 'string', 'Job posting status', required: false, enum: JobStatus::class, example: 'published')]
    #[BodyParam('is_remote', 'boolean', 'Whether the job is remote', required: false, example: true)]
    #[BodyParam('published_at', 'string', 'When the job was published', required: false, example: '2023-05-10T00:00:00Z')]
    #[BodyParam('closing_date', 'string', 'When the job posting closes', required: false, example: '2023-06-15T00:00:00Z')]
    public function update(Request $request, JobOpening $jobOpening): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'sometimes|required|integer|exists:companies,id',
            'hiring_manager_id' => 'sometimes|required|integer|exists:company_members,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'team' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'sometimes|required|in:full_time,part_time,contract,internship',
            'level' => 'sometimes|required|in:entry,junior,mid,senior,lead,principal',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'sometimes|required|in:draft,published,closed,archived',
            'is_remote' => 'boolean',
            'published_at' => 'nullable|date',
            'closing_date' => 'nullable|date|after:published_at',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jobOpening->update($request->all());

        return response()->json($jobOpening);
    }

    #[Endpoint('Delete a job opening')]
    public function destroy(JobOpening $jobOpening): JsonResponse
    {
        $jobOpening->delete();

        return response()->json(null, 204);
    }
}

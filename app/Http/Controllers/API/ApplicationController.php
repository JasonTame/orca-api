<?php

namespace App\Http\Controllers\API;

use App\Enums\ApplicationStatus;
use App\Enums\ReferralSource;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Applications
 */
class ApplicationController extends Controller
{
    #[Endpoint('List all applications')]
    public function index(): JsonResponse
    {
        $applications = Application::with(['jobOpening', 'candidate', 'currentStage'])->get();

        return response()->json($applications);
    }

    #[Endpoint('Store a new application')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', required: true, example: 1)]
    #[BodyParam('candidate_id', 'integer', 'The ID of the candidate', required: true, example: 1)]
    #[BodyParam('code_sample_url', 'string', "URL to the candidate's code sample", example: 'https://github.com/username/repo')]
    #[BodyParam('status', 'string', 'The status of the application', required: true, enum: ApplicationStatus::class, example: 'applied')]
    #[BodyParam('current_stage_id', 'integer', 'The ID of the current interview stage', example: 1)]
    #[BodyParam('rejection_reason', 'string', 'Reason for rejection', example: 'Position filled')]
    #[BodyParam('notes', 'string', 'Additional notes about the application', example: 'Candidate seems promising')]
    #[BodyParam('referral_source', 'string', 'Source of the referral', enum: ReferralSource::class, example: 'linkedin')]
    #[BodyParam('applied_at', 'date', 'The date when the candidate applied', example: '2023-05-15')]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'required|integer|exists:job_openings,id',
            'candidate_id' => 'required|integer|exists:candidates,id',
            'code_sample_url' => 'nullable|url',
            'status' => 'required|in:'.implode(',', ApplicationStatus::values()),
            'current_stage_id' => 'nullable|exists:interview_stages,id',
            'rejection_reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'referral_source' => 'nullable|string|in:'.implode(',', ReferralSource::values()),
            'applied_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application = Application::create($request->all());

        return response()->json($application, 201);
    }

    #[Endpoint('Get a single application')]
    public function show(Application $application): JsonResponse
    {
        $application->load(['jobOpening', 'candidate', 'currentStage', 'interviews']);

        return response()->json($application);
    }

    #[Endpoint('Update an existing application')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', example: 1)]
    #[BodyParam('candidate_id', 'integer', 'The ID of the candidate', example: 1)]
    #[BodyParam('code_sample_url', 'string', "URL to the candidate's code sample", example: 'https://github.com/username/repo')]
    #[BodyParam('status', 'string', 'The status of the application', enum: ApplicationStatus::class, example: 'applied')]
    #[BodyParam('current_stage_id', 'integer', 'The ID of the current interview stage', example: 1)]
    #[BodyParam('rejection_reason', 'string', 'Reason for rejection', example: 'Position filled')]
    #[BodyParam('notes', 'string', 'Additional notes about the application', example: 'Candidate seems promising')]
    #[BodyParam('referral_source', 'string', 'Source of the referral', enum: ReferralSource::class, example: 'linkedin')]
    #[BodyParam('applied_at', 'date', 'The date when the candidate applied', example: '2023-05-15')]
    public function update(Request $request, Application $application): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'sometimes|required|exists:job_openings,id',
            'candidate_id' => 'sometimes|required|exists:candidates,id',
            'code_sample_url' => 'nullable|url',
            'status' => 'sometimes|required|in:'.implode(',', ApplicationStatus::values()),
            'current_stage_id' => 'nullable|exists:interview_stages,id',
            'rejection_reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'referral_source' => 'nullable|string|in:'.implode(',', ReferralSource::values()),
            'applied_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application->update($request->all());

        return response()->json($application);
    }

    #[Endpoint('Delete an application')]
    public function destroy(Application $application): JsonResponse
    {
        $application->delete();

        return response()->json(null, 204);
    }
}

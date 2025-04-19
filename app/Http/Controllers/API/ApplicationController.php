<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Applications
 */
class ApplicationController extends Controller
{
    public function index(): JsonResponse
    {
        $applications = Application::with(['jobOpening', 'candidate', 'currentStage'])->get();

        return response()->json($applications);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'required|exists:job_openings,id',
            'candidate_id' => 'required|exists:candidates,id',
            'code_sample_url' => 'nullable|url',
            'status' => 'required|in:pending,reviewing,interviewing,offered,accepted,rejected',
            'current_stage_id' => 'nullable|exists:interview_stages,id',
            'rejection_reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'referral_source' => 'nullable|string|max:255',
            'applied_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application = Application::create($request->all());

        return response()->json($application, 201);
    }

    public function show(Application $application): JsonResponse
    {
        $application->load(['jobOpening', 'candidate', 'currentStage', 'interviews']);

        return response()->json($application);
    }

    public function update(Request $request, Application $application): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'sometimes|required|exists:job_openings,id',
            'candidate_id' => 'sometimes|required|exists:candidates,id',
            'code_sample_url' => 'nullable|url',
            'status' => 'sometimes|required|in:pending,reviewing,interviewing,offered,accepted,rejected',
            'current_stage_id' => 'nullable|exists:interview_stages,id',
            'rejection_reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'referral_source' => 'nullable|string|max:255',
            'applied_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application->update($request->all());

        return response()->json($application);
    }

    public function destroy(Application $application): JsonResponse
    {
        $application->delete();

        return response()->json(null, 204);
    }
}

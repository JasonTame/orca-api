<?php

namespace App\Http\Controllers\API;

use App\Enums\JobType;
use App\Enums\JobLevel;
use App\Enums\JobStatus;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group Job Openings
 */
class JobOpeningController extends Controller
{
    public function index(): JsonResponse
    {
        $jobOpenings = JobOpening::with(['company', 'hiringManager', 'applications'])->get();

        return response()->json($jobOpenings);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'hiring_manager_id' => 'required|exists:company_members,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:' . implode(',', JobType::values()),
            'level' => 'required|in:' . implode(',', JobLevel::values()),
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:' . implode(',', JobStatus::values()),
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

    public function show(JobOpening $jobOpening): JsonResponse
    {
        $jobOpening->load(['company', 'hiringManager', 'applications']);

        return response()->json($jobOpening);
    }

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

    public function destroy(JobOpening $jobOpening): JsonResponse
    {
        $jobOpening->delete();

        return response()->json(null, 204);
    }
}

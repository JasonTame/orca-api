<?php

namespace App\Http\Controllers\API;

use App\Enums\InterviewDecision;
use App\Enums\InterviewStatus;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Interviews
 */
class InterviewController extends Controller
{
    public function index(): JsonResponse
    {
        $interviews = Interview::with(['application', 'stage', 'interviewer'])->get();

        return response()->json($interviews);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'application_id' => 'required|integer|exists:applications,id',
            'stage_id' => 'required|integer|exists:interview_stages,id',
            'interviewer_id' => 'required|integer|exists:company_members,id',
            'scheduled_at' => 'required|date|after:now',
            'completed_at' => 'nullable|date|after:scheduled_at',
            'location' => 'nullable|string|max:255',
            'meeting_url' => 'nullable|url',
            'status' => 'required|in:'.implode(',', InterviewStatus::values()),
            'technical_score' => 'nullable|integer|min:1|max:5',
            'cultural_score' => 'nullable|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'decision' => 'nullable|in:'.implode(',', InterviewDecision::values()),
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $interview = Interview::create($request->all());

        return response()->json($interview, 201);
    }

    public function show(Interview $interview): JsonResponse
    {
        $interview->load(['application', 'stage', 'interviewer']);

        return response()->json($interview);
    }

    public function update(Request $request, Interview $interview): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'application_id' => 'sometimes|required|exists:applications,id',
            'stage_id' => 'sometimes|required|exists:interview_stages,id',
            'interviewer_id' => 'sometimes|required|exists:company_members,id',
            'scheduled_at' => 'sometimes|required|date|after:now',
            'completed_at' => 'nullable|date|after:scheduled_at',
            'location' => 'nullable|string|max:255',
            'meeting_url' => 'nullable|url',
            'status' => 'sometimes|required|in:'.implode(',', InterviewStatus::values()),
            'technical_score' => 'nullable|integer|min:1|max:5',
            'cultural_score' => 'nullable|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'decision' => 'nullable|in:'.implode(',', InterviewDecision::values()),
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $interview->update($request->all());

        return response()->json($interview);
    }

    public function destroy(Interview $interview): JsonResponse
    {
        $interview->delete();

        return response()->json(null, 204);
    }
}

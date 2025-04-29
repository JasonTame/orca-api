<?php

namespace App\Http\Controllers\API;

use App\Enums\InterviewDecision;
use App\Enums\InterviewStatus;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Interviews
 */
class InterviewController extends Controller
{
    #[Endpoint('List all interviews')]
    public function index(): JsonResponse
    {
        $interviews = Interview::with(['application', 'stage', 'interviewer'])->get();

        return response()->json($interviews);
    }

    #[Endpoint('Create a new interview')]
    #[BodyParam('application_id', 'integer', 'The ID of the application', required: true, example: 1)]
    #[BodyParam('stage_id', 'integer', 'The ID of the interview stage', required: true, example: 1)]
    #[BodyParam('interviewer_id', 'integer', 'The ID of the interviewer', required: true, example: 1)]
    #[BodyParam('scheduled_at', 'string', 'When the interview is scheduled', required: true, example: '2023-05-15T10:00:00Z')]
    #[BodyParam('completed_at', 'string', 'When the interview was completed', required: false, example: '2023-05-15T11:00:00Z')]
    #[BodyParam('location', 'string', 'Physical location of the interview', required: false, example: 'Conference Room 3A')]
    #[BodyParam('meeting_url', 'string', 'URL for virtual meetings', required: false, example: 'https://zoom.us/j/123456789')]
    #[BodyParam('status', 'string', 'Status of the interview', required: true, enum: InterviewStatus::class, example: 'scheduled')]
    #[BodyParam('technical_score', 'integer', 'Technical assessment score (1-5)', required: false, example: 4)]
    #[BodyParam('cultural_score', 'integer', 'Cultural fit score (1-5)', required: false, example: 5)]
    #[BodyParam('feedback', 'string', 'Detailed feedback from the interviewer', required: false, example: 'Strong technical skills, especially in database design. Good communication.')]
    #[BodyParam('decision', 'string', 'Interview decision', required: false, enum: InterviewDecision::class, example: 'proceed')]
    #[BodyParam('notes', 'string', 'Additional notes about the interview', required: false, example: 'Candidate was very well prepared.')]
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

    #[Endpoint('Get a single interview')]
    public function show(Interview $interview): JsonResponse
    {
        $interview->load(['application', 'stage', 'interviewer']);

        return response()->json($interview);
    }

    #[Endpoint('Update an interview')]
    #[BodyParam('application_id', 'integer', 'The ID of the application', required: true, example: 1)]
    #[BodyParam('stage_id', 'integer', 'The ID of the interview stage', required: true, example: 2)]
    #[BodyParam('interviewer_id', 'integer', 'The ID of the interviewer', required: true, example: 3)]
    #[BodyParam('scheduled_at', 'string', 'When the interview is scheduled', required: true, example: '2023-05-20T14:00:00Z')]
    #[BodyParam('completed_at', 'string', 'When the interview was completed', required: false, example: '2023-05-20T15:30:00Z')]
    #[BodyParam('location', 'string', 'Physical location of the interview', required: false, example: 'Meeting Room B')]
    #[BodyParam('meeting_url', 'string', 'URL for virtual meetings', required: false, example: 'https://teams.microsoft.com/l/123456')]
    #[BodyParam('status', 'string', 'Status of the interview', required: true, enum: InterviewStatus::class, example: 'completed')]
    #[BodyParam('technical_score', 'integer', 'Technical assessment score (1-5)', required: false, example: 4)]
    #[BodyParam('cultural_score', 'integer', 'Cultural fit score (1-5)', required: false, example: 4)]
    #[BodyParam('feedback', 'string', 'Detailed feedback from the interviewer', required: false, example: 'Excellent problem-solving skills. Good culture fit.')]
    #[BodyParam('decision', 'string', 'Interview decision', required: false, enum: InterviewDecision::class, example: 'hire')]
    #[BodyParam('notes', 'string', 'Additional notes about the interview', required: false, example: 'Would be a great fit for the team.')]
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

    #[Endpoint('Delete an interview')]
    public function destroy(Interview $interview): JsonResponse
    {
        $interview->delete();

        return response()->json(null, 204);
    }
}

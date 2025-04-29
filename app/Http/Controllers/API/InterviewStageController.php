<?php

namespace App\Http\Controllers\API;

use App\Enums\InterviewFormat;
use App\Http\Controllers\Controller;
use App\Models\InterviewStage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Interview Stages
 */
class InterviewStageController extends Controller
{
    #[Endpoint('List all interview stages')]
    public function index(): JsonResponse
    {
        $interviewStages = InterviewStage::with(['jobOpening', 'interviews'])->get();

        return response()->json($interviewStages);
    }

    #[Endpoint('Store a new interview stage')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', required: true, example: 1)]
    #[BodyParam('name', 'string', 'Name of the interview stage', required: true, example: 'Technical Interview')]
    #[BodyParam('description', 'string', 'Description of the interview stage', example: 'In-depth technical assessment with the development team')]
    #[BodyParam('sequence', 'integer', 'Order of the stage in the interview process', required: true, example: 2)]
    #[BodyParam('duration', 'integer', 'Duration of the interview stage in minutes', required: true, example: 60)]
    #[BodyParam('format', 'string', 'Format of the interview', required: true, enum: InterviewFormat::class, example: 'video')]
    #[BodyParam('is_technical', 'boolean', 'Whether this is a technical interview stage', example: true)]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'required|integer|exists:job_openings,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sequence' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'format' => 'required|in:' . implode(',', InterviewFormat::values()),
            'is_technical' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $interviewStage = InterviewStage::create($request->all());

        return response()->json($interviewStage, 201);
    }

    #[Endpoint('Get a single interview stage')]
    public function show(InterviewStage $interviewStage): JsonResponse
    {
        $interviewStage->load(['jobOpening', 'interviews']);

        return response()->json($interviewStage);
    }

    #[Endpoint('Update an existing interview stage')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', example: 1)]
    #[BodyParam('name', 'string', 'Name of the interview stage', example: 'System Design Interview')]
    #[BodyParam('description', 'string', 'Description of the interview stage', example: 'Evaluation of system design and architecture skills')]
    #[BodyParam('sequence', 'integer', 'Order of the stage in the interview process', example: 3)]
    #[BodyParam('duration', 'integer', 'Duration of the interview stage in minutes', example: 90)]
    #[BodyParam('format', 'string', 'Format of the interview', enum: InterviewFormat::class, example: 'in_person')]
    #[BodyParam('is_technical', 'boolean', 'Whether this is a technical interview stage', example: true)]
    public function update(Request $request, InterviewStage $interviewStage): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'sometimes|required|integer|exists:job_openings,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'sequence' => 'sometimes|required|integer|min:1',
            'duration' => 'sometimes|required|integer|min:1',
            'format' => 'sometimes|required|in:' . implode(',', InterviewFormat::values()),
            'is_technical' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $interviewStage->update($request->all());

        return response()->json($interviewStage);
    }

    #[Endpoint('Delete an interview stage')]
    public function destroy(InterviewStage $interviewStage): JsonResponse
    {
        $interviewStage->delete();

        return response()->json(null, 204);
    }
}

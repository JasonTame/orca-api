<?php

namespace App\Http\Controllers\API;

use App\Enums\ChallengeDifficulty;
use App\Http\Controllers\Controller;
use App\Models\CodingChallenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Coding Challenges
 */
class CodingChallengeController extends Controller
{
    #[Endpoint('List all coding challenges')]
    public function index(): JsonResponse
    {
        $codingChallenges = CodingChallenge::with(['jobOpening'])->get();

        return response()->json($codingChallenges);
    }

    #[Endpoint('Create a new coding challenge')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', required: true, example: 1)]
    #[BodyParam('title', 'string', 'Title of the coding challenge', required: true, example: 'API Integration Challenge')]
    #[BodyParam('description', 'string', 'Description of the challenge', required: true, example: 'Build a REST API integration with third-party service')]
    #[BodyParam('instructions', 'string', 'Detailed instructions for completing the challenge', required: true, example: 'Clone the repository and implement the missing endpoints according to the specification')]
    #[BodyParam('repository_url', 'string', 'URL to the challenge repository', required: true, example: 'https://github.com/company/coding-challenge')]
    #[BodyParam('time_limit', 'integer', 'Time limit in hours', required: true, example: 24)]
    #[BodyParam('difficulty', 'string', 'Difficulty level of the challenge', required: true, enum: ChallengeDifficulty::class, example: 'medium')]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'required|integer|exists:job_openings,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'repository_url' => 'required|url',
            'time_limit' => 'required|integer|min:1',
            'difficulty' => 'required|in:'.implode(',', ChallengeDifficulty::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $codingChallenge = CodingChallenge::create($request->all());

        return response()->json($codingChallenge, 201);
    }

    #[Endpoint('Get a single coding challenge')]
    public function show(CodingChallenge $codingChallenge): JsonResponse
    {
        $codingChallenge->load(['jobOpening']);

        return response()->json($codingChallenge);
    }

    #[Endpoint('Update a coding challenge')]
    #[BodyParam('job_opening_id', 'integer', 'The ID of the job opening', required: true, example: 1)]
    #[BodyParam('title', 'string', 'Title of the coding challenge', required: true, example: 'Updated API Challenge')]
    #[BodyParam('description', 'string', 'Description of the challenge', required: true, example: 'Build a REST API integration with authentication')]
    #[BodyParam('instructions', 'string', 'Detailed instructions for completing the challenge', required: true, example: 'Clone the repository and implement the missing endpoints following OAuth2 spec')]
    #[BodyParam('repository_url', 'string', 'URL to the challenge repository', required: true, example: 'https://github.com/company/updated-coding-challenge')]
    #[BodyParam('time_limit', 'integer', 'Time limit in hours', required: true, example: 48)]
    #[BodyParam('difficulty', 'string', 'Difficulty level of the challenge', required: true, enum: ChallengeDifficulty::class, example: 'hard')]
    public function update(Request $request, CodingChallenge $codingChallenge): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'sometimes|required|exists:job_openings,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'instructions' => 'sometimes|required|string',
            'repository_url' => 'sometimes|required|url',
            'time_limit' => 'sometimes|required|integer|min:1',
            'difficulty' => 'sometimes|required|in:'.implode(',', ChallengeDifficulty::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $codingChallenge->update($request->all());

        return response()->json($codingChallenge);
    }

    #[Endpoint('Delete a coding challenge')]
    public function destroy(CodingChallenge $codingChallenge): JsonResponse
    {
        $codingChallenge->delete();

        return response()->json(null, 204);
    }
}

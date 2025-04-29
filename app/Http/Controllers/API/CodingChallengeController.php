<?php

namespace App\Http\Controllers\API;

use App\Enums\ChallengeDifficulty;
use App\Http\Controllers\Controller;
use App\Models\CodingChallenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Coding Challenges
 */
class CodingChallengeController extends Controller
{
    public function index(): JsonResponse
    {
        $codingChallenges = CodingChallenge::with(['jobOpening'])->get();

        return response()->json($codingChallenges);
    }

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

    public function show(CodingChallenge $codingChallenge): JsonResponse
    {
        $codingChallenge->load(['jobOpening']);

        return response()->json($codingChallenge);
    }

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

    public function destroy(CodingChallenge $codingChallenge): JsonResponse
    {
        $codingChallenge->delete();

        return response()->json(null, 204);
    }
}

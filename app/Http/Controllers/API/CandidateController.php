<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function index(): JsonResponse
    {
        $candidates = Candidate::all();

        return response()->json($candidates);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'resume_url' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'years_experience' => 'nullable|integer|min:0',
            'current_position' => 'nullable|string|max:255',
            'current_company' => 'nullable|string|max:255',
            'desired_salary' => 'nullable|numeric|min:0',
            'source' => 'nullable|in:linkedin,indeed,referral,career_site,other',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:active,inactive,hired,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $candidate = Candidate::create($request->all());

        return response()->json($candidate, 201);
    }

    public function show(Candidate $candidate): JsonResponse
    {
        return response()->json($candidate);
    }

    public function update(Request $request, Candidate $candidate): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:candidates,email,'.$candidate->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'resume_url' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'years_experience' => 'nullable|integer|min:0',
            'current_position' => 'nullable|string|max:255',
            'current_company' => 'nullable|string|max:255',
            'desired_salary' => 'nullable|numeric|min:0',
            'source' => 'nullable|in:linkedin,indeed,referral,career_site,other',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:active,inactive,hired,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $candidate->update($request->all());

        return response()->json($candidate);
    }

    public function destroy(Candidate $candidate): JsonResponse
    {
        $candidate->delete();

        return response()->json(null, 204);
    }
}

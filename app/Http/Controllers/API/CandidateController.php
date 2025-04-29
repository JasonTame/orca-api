<?php

namespace App\Http\Controllers\API;

use App\Enums\CandidateSource;
use App\Enums\CandidateStatus;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Candidates
 */
class CandidateController extends Controller
{
    #[Endpoint('List all candidates')]
    public function index(Request $request): JsonResponse
    {
        if ($request->has('search')) {
            $candidates = Candidate::search($request->input('search'))->get();
        } else {
            $candidates = Candidate::all();
        }

        return response()->json($candidates);
    }

    #[Endpoint('Store a new candidate')]
    #[BodyParam('first_name', 'string', 'First name of the candidate', required: true, example: 'John')]
    #[BodyParam('last_name', 'string', 'Last name of the candidate', required: true, example: 'Doe')]
    #[BodyParam('email', 'string', 'Email address of the candidate', required: true, example: 'john.doe@example.com')]
    #[BodyParam('phone', 'string', 'Phone number of the candidate', example: '+1234567890')]
    #[BodyParam('location', 'string', 'Location of the candidate', example: 'San Francisco, CA')]
    #[BodyParam('resume_url', 'string', "URL to the candidate's resume", example: 'https://example.com/resume.pdf')]
    #[BodyParam('portfolio_url', 'string', "URL to the candidate's portfolio", example: 'https://portfolio.johnde.com')]
    #[BodyParam('linkedin_url', 'string', "URL to the candidate's LinkedIn profile", example: 'https://linkedin.com/in/johndoe')]
    #[BodyParam('years_experience', 'integer', 'Years of professional experience', example: 5)]
    #[BodyParam('current_position', 'string', 'Current job position', example: 'Senior Developer')]
    #[BodyParam('current_company', 'string', 'Current employer', example: 'Tech Corp')]
    #[BodyParam('desired_salary', 'number', 'Desired salary', example: 120000)]
    #[BodyParam('source', 'string', 'Source of the candidate', enum: CandidateSource::class, example: 'linkedin')]
    #[BodyParam('notes', 'string', 'Additional notes about the candidate', example: 'Great communication skills')]
    #[BodyParam('status', 'string', 'Status of the candidate', enum: CandidateStatus::class, example: 'new')]
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
            'source' => 'nullable|in:'.implode(',', CandidateSource::values()),
            'notes' => 'nullable|string',
            'status' => 'nullable|in:'.implode(',', CandidateStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $candidate = Candidate::create($request->all());

        return response()->json($candidate, 201);
    }

    #[Endpoint('Get a single candidate')]
    public function show(Candidate $candidate): JsonResponse
    {
        return response()->json($candidate);
    }

    #[Endpoint('Update an existing candidate')]
    #[BodyParam('first_name', 'string', 'First name of the candidate', example: 'John')]
    #[BodyParam('last_name', 'string', 'Last name of the candidate', example: 'Doe')]
    #[BodyParam('email', 'string', 'Email address of the candidate', example: 'john.doe@example.com')]
    #[BodyParam('phone', 'string', 'Phone number of the candidate', example: '+1234567890')]
    #[BodyParam('location', 'string', 'Location of the candidate', example: 'San Francisco, CA')]
    #[BodyParam('resume_url', 'string', "URL to the candidate's resume", example: 'https://example.com/resume.pdf')]
    #[BodyParam('portfolio_url', 'string', "URL to the candidate's portfolio", example: 'https://portfolio.johnde.com')]
    #[BodyParam('linkedin_url', 'string', "URL to the candidate's LinkedIn profile", example: 'https://linkedin.com/in/johndoe')]
    #[BodyParam('years_experience', 'integer', 'Years of professional experience', example: 5)]
    #[BodyParam('current_position', 'string', 'Current job position', example: 'Senior Developer')]
    #[BodyParam('current_company', 'string', 'Current employer', example: 'Tech Corp')]
    #[BodyParam('desired_salary', 'number', 'Desired salary', example: 120000)]
    #[BodyParam('source', 'string', 'Source of the candidate', enum: CandidateSource::class, example: 'linkedin')]
    #[BodyParam('notes', 'string', 'Additional notes about the candidate', example: 'Great communication skills')]
    #[BodyParam('status', 'string', 'Status of the candidate', enum: CandidateStatus::class, example: 'interviewing')]
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
            'source' => 'nullable|in:'.implode(',', CandidateSource::values()),
            'notes' => 'nullable|string',
            'status' => 'nullable|in:'.implode(',', CandidateStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $candidate->update($request->all());

        return response()->json($candidate);
    }

    #[Endpoint('Delete a candidate')]
    public function destroy(Candidate $candidate): JsonResponse
    {
        $candidate->delete();

        return response()->json(null, 204);
    }

    /**
     * Get skills for a candidate
     */
    #[Endpoint('Get candidate skills')]
    public function skills(Candidate $candidate): JsonResponse
    {
        $skills = $candidate->skills()->with('skill')->get();

        return response()->json($skills);
    }

    /**
     * Get applications for a candidate
     */
    #[Endpoint('Get candidate applications')]
    public function applications(Candidate $candidate): JsonResponse
    {
        $applications = $candidate->applications()->with('jobOpening')->get();

        return response()->json($applications);
    }
}

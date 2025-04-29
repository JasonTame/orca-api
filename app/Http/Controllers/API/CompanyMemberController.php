<?php

namespace App\Http\Controllers\API;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Models\CompanyMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Company Members
 */
class CompanyMemberController extends Controller
{
    #[Endpoint('List all company members')]
    public function index(Request $request): JsonResponse
    {
        $query = CompanyMember::with(['company', 'jobOpenings', 'interviews']);

        if ($request->has('company_id')) {
            $query->where('company_id', $request->input('company_id'));
        }

        $companyMembers = $query->get();

        return response()->json($companyMembers);
    }

    #[Endpoint('Create a new company member')]
    #[BodyParam('company_id', 'integer', 'The ID of the company', required: true, example: 1)]
    #[BodyParam('name', 'string', 'Full name of the company member', required: true, example: 'Jane Smith')]
    #[BodyParam('email', 'string', 'Email address of the company member', required: true, example: 'jane.smith@company.com')]
    #[BodyParam('position', 'string', 'Job position within the company', required: true, example: 'Senior Recruiter')]
    #[BodyParam('department', 'string', 'Department within the company', required: true, example: 'Human Resources')]
    #[BodyParam('phone', 'string', 'Contact phone number', required: true, example: '+1 (555) 123-4567')]
    #[BodyParam('is_hiring_manager', 'boolean', 'Whether this member is a hiring manager', required: false, example: true)]
    #[BodyParam('is_recruiter', 'boolean', 'Whether this member is a recruiter', required: false, example: true)]
    #[BodyParam('is_interviewer', 'boolean', 'Whether this member conducts interviews', required: false, example: false)]
    #[BodyParam('status', 'string', 'Status of the company member', required: true, enum: EntityStatus::class, example: 'active')]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|exists:companies,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:company_members,email',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'is_hiring_manager' => 'boolean',
            'is_recruiter' => 'boolean',
            'is_interviewer' => 'boolean',
            'status' => 'required|in:'.implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $companyMember = CompanyMember::create($request->all());

        return response()->json($companyMember, 201);
    }

    #[Endpoint('Get a single company member')]
    public function show(CompanyMember $companyMember): JsonResponse
    {
        $companyMember->load(['company', 'jobOpenings', 'interviews']);

        return response()->json($companyMember);
    }

    #[Endpoint('Update a company member')]
    #[BodyParam('company_id', 'integer', 'The ID of the company', required: true, example: 1)]
    #[BodyParam('name', 'string', 'Full name of the company member', required: true, example: 'Jane Smith Updated')]
    #[BodyParam('email', 'string', 'Email address of the company member', required: true, example: 'jane.updated@company.com')]
    #[BodyParam('position', 'string', 'Job position within the company', required: true, example: 'Lead Recruiter')]
    #[BodyParam('department', 'string', 'Department within the company', required: true, example: 'Talent Acquisition')]
    #[BodyParam('phone', 'string', 'Contact phone number', required: true, example: '+1 (555) 987-6543')]
    #[BodyParam('is_hiring_manager', 'boolean', 'Whether this member is a hiring manager', required: false, example: true)]
    #[BodyParam('is_recruiter', 'boolean', 'Whether this member is a recruiter', required: false, example: true)]
    #[BodyParam('is_interviewer', 'boolean', 'Whether this member conducts interviews', required: false, example: true)]
    #[BodyParam('status', 'string', 'Status of the company member', required: true, enum: EntityStatus::class, example: 'active')]
    public function update(Request $request, CompanyMember $companyMember): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'sometimes|required|exists:companies,id',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:company_members,email,'.$companyMember->id,
            'position' => 'sometimes|required|string|max:255',
            'department' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'is_hiring_manager' => 'boolean',
            'is_recruiter' => 'boolean',
            'is_interviewer' => 'boolean',
            'status' => 'sometimes|required|in:'.implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $companyMember->update($request->all());

        return response()->json($companyMember);
    }

    #[Endpoint('Delete a company member')]
    public function destroy(CompanyMember $companyMember): JsonResponse
    {
        $companyMember->delete();

        return response()->json(null, 204);
    }

    #[Endpoint('Get all job openings for a company member')]
    public function jobOpenings(CompanyMember $companyMember): JsonResponse
    {
        $jobOpenings = $companyMember->jobOpenings()
            ->with(['company', 'applications'])
            ->get();

        return response()->json($jobOpenings);
    }

    #[Endpoint('Get all interviews for a company member')]
    public function interviews(CompanyMember $companyMember): JsonResponse
    {
        $interviews = $companyMember->interviews()
            ->with(['application', 'stage'])
            ->get();

        return response()->json($interviews);
    }
}

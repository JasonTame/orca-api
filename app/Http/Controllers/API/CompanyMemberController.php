<?php

namespace App\Http\Controllers\API;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Models\CompanyMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Company Members
 */
class CompanyMemberController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = CompanyMember::with(['company', 'jobOpenings', 'interviews']);

        if ($request->has('company_id')) {
            $query->where('company_id', $request->input('company_id'));
        }

        $companyMembers = $query->get();

        return response()->json($companyMembers);
    }

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
            'status' => 'required|in:' . implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $companyMember = CompanyMember::create($request->all());

        return response()->json($companyMember, 201);
    }

    public function show(CompanyMember $companyMember): JsonResponse
    {
        $companyMember->load(['company', 'jobOpenings', 'interviews']);

        return response()->json($companyMember);
    }

    public function update(Request $request, CompanyMember $companyMember): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'sometimes|required|exists:companies,id',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:company_members,email,' . $companyMember->id,
            'position' => 'sometimes|required|string|max:255',
            'department' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'is_hiring_manager' => 'boolean',
            'is_recruiter' => 'boolean',
            'is_interviewer' => 'boolean',
            'status' => 'sometimes|required|in:' . implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $companyMember->update($request->all());

        return response()->json($companyMember);
    }

    public function destroy(CompanyMember $companyMember): JsonResponse
    {
        $companyMember->delete();

        return response()->json(null, 204);
    }

    public function jobOpenings(CompanyMember $companyMember): JsonResponse
    {
        $jobOpenings = $companyMember->jobOpenings()
            ->with(['company', 'applications'])
            ->get();

        return response()->json($jobOpenings);
    }

    public function interviews(CompanyMember $companyMember): JsonResponse
    {
        $interviews = $companyMember->interviews()
            ->with(['application', 'stage'])
            ->get();

        return response()->json($interviews);
    }
}

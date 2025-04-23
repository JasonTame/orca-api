<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Companies
 */
class CompanyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->has('search')) {
            $companies = Company::search($request->input('search'))->get();
        } else {
            $companies = Company::all();
        }

        return response()->json($companies);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|in:small,medium,large,enterprise',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company = Company::create($request->all());

        return response()->json($company, 201);
    }

    public function show(Company $company): JsonResponse
    {
        return response()->json($company);
    }

    public function update(Request $request, Company $company): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'logo_url' => 'nullable|url',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|in:small,medium,large,enterprise',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company->update($request->all());

        return response()->json($company);
    }

    public function destroy(Company $company): JsonResponse
    {
        $company->delete();

        return response()->json(null, 204);
    }

    public function jobOpenings(Company $company): JsonResponse
    {
        $jobOpenings = $company->jobOpenings;

        return response()->json($jobOpenings);
    }

    public function members(Company $company): JsonResponse
    {
        $members = $company->members;

        return response()->json($members);
    }

    public function hiringManagers(Company $company): JsonResponse
    {
        $hiringManagers = $company->members()->where('is_hiring_manager', true)->get();

        return response()->json($hiringManagers);
    }

    public function interviewers(Company $company): JsonResponse
    {
        $interviewers = $company->members()->where('is_interviewer', true)->get();

        return response()->json($interviewers);
    }
}

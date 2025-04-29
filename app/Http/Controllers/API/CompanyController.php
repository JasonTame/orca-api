<?php

namespace App\Http\Controllers\API;

use App\Enums\CompanySize;
use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Companies
 */
class CompanyController extends Controller
{
    #[Endpoint('List all companies')]
    public function index(Request $request): JsonResponse
    {
        if ($request->has('search')) {
            $companies = Company::search($request->input('search'))->get();
        } else {
            $companies = Company::all();
        }

        return response()->json($companies);
    }

    #[Endpoint('Create a new company')]
    #[BodyParam('name', 'string', 'Name of the company', required: true, example: 'Acme Corporation')]
    #[BodyParam('logo_url', 'string', "URL to the company's logo", required: false, example: 'https://example.com/logo.png')]
    #[BodyParam('website', 'string', 'Company website URL', required: false, example: 'https://acme.example.com')]
    #[BodyParam('industry', 'string', 'Industry the company operates in', required: false, example: 'Technology')]
    #[BodyParam('size', 'string', 'Size of the company', required: false, enum: CompanySize::class, example: 'medium')]
    #[BodyParam('description', 'string', 'Company description', required: false, example: 'A leading provider of innovative solutions')]
    #[BodyParam('location', 'string', 'Main location of the company', required: false, example: 'San Francisco, CA')]
    #[BodyParam('status', 'string', 'Status of the company', required: false, enum: EntityStatus::class, example: 'active')]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|in:'.implode(',', CompanySize::values()),
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:'.implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company = Company::create($request->all());

        return response()->json($company, 201);
    }

    #[Endpoint('Get a single company')]
    public function show(Company $company): JsonResponse
    {
        return response()->json($company);
    }

    #[Endpoint('Update a company')]
    #[BodyParam('name', 'string', 'Name of the company', required: true, example: 'Acme Corporation Updated')]
    #[BodyParam('logo_url', 'string', "URL to the company's logo", required: false, example: 'https://example.com/new-logo.png')]
    #[BodyParam('website', 'string', 'Company website URL', required: false, example: 'https://acme-updated.example.com')]
    #[BodyParam('industry', 'string', 'Industry the company operates in', required: false, example: 'Software')]
    #[BodyParam('size', 'string', 'Size of the company', required: false, enum: CompanySize::class, example: 'large')]
    #[BodyParam('description', 'string', 'Company description', required: false, example: 'A global leader in software solutions')]
    #[BodyParam('location', 'string', 'Main location of the company', required: false, example: 'New York, NY')]
    #[BodyParam('status', 'string', 'Status of the company', required: false, enum: EntityStatus::class, example: 'active')]
    public function update(Request $request, Company $company): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'logo_url' => 'nullable|url',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|in:'.implode(',', CompanySize::values()),
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:'.implode(',', EntityStatus::values()),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company->update($request->all());

        return response()->json($company);
    }

    #[Endpoint('Delete a company')]
    public function destroy(Company $company): JsonResponse
    {
        $company->delete();

        return response()->json(null, 204);
    }

    #[Endpoint('Get all job openings for a company')]
    public function jobOpenings(Company $company): JsonResponse
    {
        $jobOpenings = $company->jobOpenings;

        return response()->json($jobOpenings);
    }

    #[Endpoint('Get all members for a company')]
    public function members(Company $company): JsonResponse
    {
        $members = $company->members;

        return response()->json($members);
    }

    #[Endpoint('Get all hiring managers for a company')]
    public function hiringManagers(Company $company): JsonResponse
    {
        $hiringManagers = $company->members()->where('is_hiring_manager', true)->get();

        return response()->json($hiringManagers);
    }

    #[Endpoint('Get all interviewers for a company')]
    public function interviewers(Company $company): JsonResponse
    {
        $interviewers = $company->members()->where('is_interviewer', true)->get();

        return response()->json($interviewers);
    }
}

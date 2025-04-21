<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\CodingChallengeController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CompanyMemberController;
use App\Http\Controllers\API\InterviewController;
use App\Http\Controllers\API\JobOpeningController;
use App\Http\Controllers\API\TechSkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('tech-skills/categories', [TechSkillController::class, 'categories']);
    Route::apiResource('tech-skills', TechSkillController::class);

    // Companies
    Route::apiResource('companies', CompanyController::class);
    Route::get('companies/{company}/job-openings', [CompanyController::class, 'jobOpenings']);
    Route::get('companies/{company}/members', [CompanyController::class, 'members']);
    Route::get('companies/{company}/hiring-managers', [CompanyController::class, 'hiringManagers']);
    Route::get('companies/{company}/interviewers', [CompanyController::class, 'interviewers']);

    // Company Members
    Route::apiResource('company-members', CompanyMemberController::class);
    Route::get('company-members/{companyMember}/job-openings', [CompanyMemberController::class, 'jobOpenings']);
    Route::get('company-members/{companyMember}/interviews', [CompanyMemberController::class, 'interviews']);

    Route::apiResource('candidates', CandidateController::class);
    Route::apiResource('job-openings', JobOpeningController::class);
    Route::apiResource('applications', ApplicationController::class);
    Route::apiResource('interviews', InterviewController::class);
    Route::apiResource('coding-challenges', CodingChallengeController::class);
});

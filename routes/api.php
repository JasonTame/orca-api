<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\JobOpeningController;
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
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('candidates', CandidateController::class);
    Route::apiResource('job-openings', JobOpeningController::class);
    Route::apiResource('applications', ApplicationController::class);
});

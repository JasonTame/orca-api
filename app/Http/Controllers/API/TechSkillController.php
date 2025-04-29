<?php

namespace App\Http\Controllers\API;

use App\Enums\TechSkillCategory;
use App\Http\Controllers\Controller;
use App\Models\TechSkill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Tech Skills
 */
class TechSkillController extends Controller
{
    public function index(): JsonResponse
    {
        $techSkills = TechSkill::all();

        return response()->json($techSkills);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tech_skills,name',
            'category' => 'required|in:'.implode(',', TechSkillCategory::values()),
            'parent_skill_id' => 'nullable|integer|exists:tech_skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $techSkill = TechSkill::create($request->all());

        return response()->json($techSkill, 201);
    }

    public function show(TechSkill $techSkill): JsonResponse
    {
        return response()->json($techSkill);
    }

    public function update(Request $request, TechSkill $techSkill): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:tech_skills,name,'.$techSkill->id,
            'category' => 'sometimes|required|in:language,framework,database,tool,platform',
            'parent_skill_id' => 'nullable|integer|exists:tech_skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $techSkill->update($request->all());

        return response()->json($techSkill);
    }

    public function destroy(TechSkill $techSkill): JsonResponse
    {
        $techSkill->delete();

        return response()->json(null, 204);
    }

    public function categories(): JsonResponse
    {
        return response()->json([
            'language',
            'framework',
            'database',
            'tool',
            'platform',
        ]);
    }
}

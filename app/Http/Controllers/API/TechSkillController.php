<?php

namespace App\Http\Controllers\API;

use App\Enums\TechSkillCategory;
use App\Http\Controllers\Controller;
use App\Models\TechSkill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;

/**
 * @group Tech Skills
 */
class TechSkillController extends Controller
{
    #[Endpoint("List all tech skills")]
    public function index(): JsonResponse
    {
        $techSkills = TechSkill::all();

        return response()->json($techSkills);
    }

    #[Endpoint("Create a new tech skill")]
    #[BodyParam("name", "string", "Name of the tech skill", required: true, example: "React")]
    #[BodyParam("category", "string", "Category of the tech skill", required: true, enum: TechSkillCategory::class, example: "framework")]
    #[BodyParam("parent_skill_id", "integer", "ID of the parent skill (if this is a sub-skill)", example: 1)]
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tech_skills,name',
            'category' => 'required|in:' . implode(',', TechSkillCategory::values()),
            'parent_skill_id' => 'nullable|integer|exists:tech_skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $techSkill = TechSkill::create($request->all());

        return response()->json($techSkill, 201);
    }

    #[Endpoint("Get a single tech skill")]
    public function show(TechSkill $techSkill): JsonResponse
    {
        return response()->json($techSkill);
    }

    #[Endpoint("Update a tech skill")]
    #[BodyParam("name", "string", "Name of the tech skill", example: "React Native")]
    #[BodyParam("category", "string", "Category of the tech skill", enum: TechSkillCategory::class, example: "framework")]
    #[BodyParam("parent_skill_id", "integer", "ID of the parent skill (if this is a sub-skill)", example: 2)]
    public function update(Request $request, TechSkill $techSkill): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:tech_skills,name,' . $techSkill->id,
            'category' => 'sometimes|required|in:' . implode(',', TechSkillCategory::values()),
            'parent_skill_id' => 'nullable|integer|exists:tech_skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $techSkill->update($request->all());

        return response()->json($techSkill);
    }

    #[Endpoint("Delete a tech skill")]
    public function destroy(TechSkill $techSkill): JsonResponse
    {
        $techSkill->delete();

        return response()->json(null, 204);
    }

    #[Endpoint("Get all tech skill categories")]
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

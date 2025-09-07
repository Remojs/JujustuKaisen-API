<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Http\Resources\CharacterResource;
use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Constants\SpeciesConstants;
use App\Constants\GradeConstants;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Character::query();

        // Search by name or description
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Filter by gender
        if ($request->has('gender')) {
            try {
                $gender = GenderEnum::from($request->gender);
                $query->byGender($gender);
            } catch (\ValueError $e) {
                return response()->json(['error' => 'Invalid gender value'], 400);
            }
        }

        // Filter by status
        if ($request->has('status')) {
            try {
                $status = StatusEnum::from($request->status);
                $query->byStatus($status);
            } catch (\ValueError $e) {
                return response()->json(['error' => 'Invalid status value'], 400);
            }
        }

        // Filter by species
        if ($request->has('species')) {
            if (!SpeciesConstants::exists($request->species)) {
                return response()->json(['error' => 'Invalid species ID'], 400);
            }
            $query->bySpecies($request->species);
        }

        // Filter by grade
        if ($request->has('grade')) {
            if (!GradeConstants::exists($request->grade)) {
                return response()->json(['error' => 'Invalid grade ID'], 400);
            }
            $query->byGrade($request->grade);
        }

        // Filter by location
        if ($request->has('location_id')) {
            $query->byLocation($request->location_id);
        }

        // Include relationships if requested
        if ($request->boolean('include_full_data')) {
            $query->withFullData();
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 100); // Max 100 per page
        $characters = $query->paginate($perPage);

        return response()->json([
            'data' => CharacterResource::collection($characters),
            'pagination' => [
                'current_page' => $characters->currentPage(),
                'last_page' => $characters->lastPage(),
                'per_page' => $characters->perPage(),
                'total' => $characters->total(),
                'from' => $characters->firstItem(),
                'to' => $characters->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:characters',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'gender' => 'nullable|in:' . implode(',', array_column(GenderEnum::cases(), 'value')),
            'age' => 'nullable|string|max:10',
            'birthday' => 'nullable|date',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'hair_color' => 'nullable|string|max:100',
            'eye_color' => 'nullable|string|max:100',
            'status' => 'nullable|in:' . implode(',', array_column(StatusEnum::cases(), 'value')),
            'species_id' => 'required|integer|min:1|max:' . count(SpeciesConstants::getAll()),
            'grade_id' => 'nullable|integer|min:1|max:' . count(GradeConstants::getAll()),
            'location_id' => 'nullable|exists:locations,id',
            'abilities' => 'nullable|array',
            'first_appearance_manga' => 'nullable|string|max:50',
            'first_appearance_anime' => 'nullable|string|max:50',
        ]);

        $character = Character::create($validated);

        return response()->json([
            'message' => 'Character created successfully',
            'data' => new CharacterResource($character)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Character $character): JsonResponse
    {
        // Load relationships if requested
        if ($request->boolean('include_full_data')) {
            $character->load([
                'location',
                'occupations',
                'affiliations',
                'cursedTechniques',
                'cursedTools',
                'battles',
                'nonDirectBattles'
            ]);
        }

        return response()->json([
            'data' => new CharacterResource($character)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:characters,name,' . $character->id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'gender' => 'nullable|in:' . implode(',', array_column(GenderEnum::cases(), 'value')),
            'age' => 'nullable|string|max:10',
            'birthday' => 'nullable|date',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'hair_color' => 'nullable|string|max:100',
            'eye_color' => 'nullable|string|max:100',
            'status' => 'nullable|in:' . implode(',', array_column(StatusEnum::cases(), 'value')),
            'species_id' => 'sometimes|integer|min:1|max:' . count(SpeciesConstants::getAll()),
            'grade_id' => 'nullable|integer|min:1|max:' . count(GradeConstants::getAll()),
            'location_id' => 'nullable|exists:locations,id',
            'abilities' => 'nullable|array',
            'first_appearance_manga' => 'nullable|string|max:50',
            'first_appearance_anime' => 'nullable|string|max:50',
        ]);

        $character->update($validated);

        return response()->json([
            'message' => 'Character updated successfully',
            'data' => new CharacterResource($character)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character): JsonResponse
    {
        $character->delete();

        return response()->json([
            'message' => 'Character deleted successfully'
        ]);
    }

    /**
     * Get character's battles (both direct and indirect).
     */
    public function battles(Character $character): JsonResponse
    {
        $battles = $character->allBattles()->with('location')->paginate(15);

        return response()->json([
            'data' => \App\Http\Resources\BattleResource::collection($battles),
            'pagination' => [
                'current_page' => $battles->currentPage(),
                'last_page' => $battles->lastPage(),
                'per_page' => $battles->perPage(),
                'total' => $battles->total(),
            ]
        ]);
    }

    /**
     * Get available filter options.
     */
    public function filters(): JsonResponse
    {
        return response()->json([
            'genders' => collect(GenderEnum::cases())->map(fn($gender) => [
                'value' => $gender->value,
                'label' => $gender->label()
            ]),
            'statuses' => collect(StatusEnum::cases())->map(fn($status) => [
                'value' => $status->value,
                'label' => $status->label()
            ]),
            'species' => collect(SpeciesConstants::getAll())->map(fn($name, $id) => [
                'id' => $id,
                'name' => $name
            ])->values(),
            'grades' => collect(GradeConstants::getAll())->map(fn($name, $id) => [
                'id' => $id,
                'name' => $name
            ])->values(),
        ]);
    }
}

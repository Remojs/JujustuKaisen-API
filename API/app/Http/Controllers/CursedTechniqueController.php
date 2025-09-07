<?php

namespace App\Http\Controllers;

use App\Models\CursedTechnique;
use App\Http\Resources\CursedTechniqueResource;
use App\Constants\TechniqueTypeConstants;
use App\Constants\TechniqueRangeConstants;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CursedTechniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = CursedTechnique::query();

        // Search by name or description
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Filter by type
        if ($request->has('type')) {
            if (!TechniqueTypeConstants::exists($request->type)) {
                return response()->json(['error' => 'Invalid technique type ID'], 400);
            }
            $query->byType($request->type);
        }

        // Filter by range
        if ($request->has('range')) {
            if (!TechniqueRangeConstants::exists($request->range)) {
                return response()->json(['error' => 'Invalid technique range ID'], 400);
            }
            $query->byRange($request->range);
        }

        // Include relationships if requested
        if ($request->boolean('include_relationships')) {
            $query->with(['domainExpansions', 'characters']);
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 100);
        $techniques = $query->paginate($perPage);

        return response()->json([
            'data' => CursedTechniqueResource::collection($techniques),
            'pagination' => [
                'current_page' => $techniques->currentPage(),
                'last_page' => $techniques->lastPage(),
                'per_page' => $techniques->perPage(),
                'total' => $techniques->total(),
                'from' => $techniques->firstItem(),
                'to' => $techniques->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type_id' => 'required|integer|min:1|max:' . count(TechniqueTypeConstants::getAll()),
            'range_id' => 'required|integer|min:1|max:' . count(TechniqueRangeConstants::getAll()),
            'requirements' => 'nullable|array',
            'limitations' => 'nullable|array',
            'first_appearance_manga' => 'nullable|string|max:50',
            'first_appearance_anime' => 'nullable|string|max:50',
        ]);

        $technique = CursedTechnique::create($validated);

        return response()->json([
            'message' => 'Cursed technique created successfully',
            'data' => new CursedTechniqueResource($technique)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CursedTechnique $cursedTechnique): JsonResponse
    {
        // Load relationships if requested
        if ($request->boolean('include_relationships')) {
            $cursedTechnique->load(['domainExpansions', 'characters']);
        }

        return response()->json([
            'data' => new CursedTechniqueResource($cursedTechnique)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CursedTechnique $cursedTechnique): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'type_id' => 'sometimes|integer|min:1|max:' . count(TechniqueTypeConstants::getAll()),
            'range_id' => 'sometimes|integer|min:1|max:' . count(TechniqueRangeConstants::getAll()),
            'requirements' => 'nullable|array',
            'limitations' => 'nullable|array',
            'first_appearance_manga' => 'nullable|string|max:50',
            'first_appearance_anime' => 'nullable|string|max:50',
        ]);

        $cursedTechnique->update($validated);

        return response()->json([
            'message' => 'Cursed technique updated successfully',
            'data' => new CursedTechniqueResource($cursedTechnique)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CursedTechnique $cursedTechnique): JsonResponse
    {
        $cursedTechnique->delete();

        return response()->json([
            'message' => 'Cursed technique deleted successfully'
        ]);
    }

    /**
     * Get users of this technique.
     */
    public function users(CursedTechnique $cursedTechnique): JsonResponse
    {
        $users = $cursedTechnique->characters()->paginate(15);

        return response()->json([
            'data' => \App\Http\Resources\CharacterResource::collection($users),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ]
        ]);
    }

    /**
     * Get available filter options.
     */
    public function filters(): JsonResponse
    {
        return response()->json([
            'types' => collect(TechniqueTypeConstants::getAll())->map(fn($name, $id) => [
                'id' => $id,
                'name' => $name
            ])->values(),
            'ranges' => collect(TechniqueRangeConstants::getAll())->map(fn($name, $id) => [
                'id' => $id,
                'name' => $name
            ])->values(),
        ]);
    }
}

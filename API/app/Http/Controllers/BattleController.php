<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use App\Http\Resources\BattleResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BattleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Battle::query();

        // Search by name, description, or arc
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Filter by arc
        if ($request->has('arc')) {
            $query->byArc($request->arc);
        }

        // Filter by outcome
        if ($request->has('outcome')) {
            $query->byOutcome($request->outcome);
        }

        // Filter by location
        if ($request->has('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Include relationships if requested
        if ($request->boolean('include_full_data')) {
            $query->withFullData();
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 100);
        $battles = $query->paginate($perPage);

        return response()->json([
            'data' => BattleResource::collection($battles),
            'pagination' => [
                'current_page' => $battles->currentPage(),
                'last_page' => $battles->lastPage(),
                'per_page' => $battles->perPage(),
                'total' => $battles->total(),
                'from' => $battles->firstItem(),
                'to' => $battles->lastItem(),
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
            'location_id' => 'nullable|exists:locations,id',
            'outcome' => 'nullable|string',
            'events' => 'nullable|array',
            'manga_chapters' => 'nullable|array',
            'anime_episodes' => 'nullable|array',
            'arc_name' => 'nullable|string|max:255',
        ]);

        $battle = Battle::create($validated);

        return response()->json([
            'message' => 'Battle created successfully',
            'data' => new BattleResource($battle)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Battle $battle): JsonResponse
    {
        // Load relationships if requested
        if ($request->boolean('include_full_data')) {
            $battle->load(['location', 'participants', 'nonDirectParticipants']);
        }

        return response()->json([
            'data' => new BattleResource($battle)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Battle $battle): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location_id' => 'nullable|exists:locations,id',
            'outcome' => 'nullable|string',
            'events' => 'nullable|array',
            'manga_chapters' => 'nullable|array',
            'anime_episodes' => 'nullable|array',
            'arc_name' => 'nullable|string|max:255',
        ]);

        $battle->update($validated);

        return response()->json([
            'message' => 'Battle updated successfully',
            'data' => new BattleResource($battle)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Battle $battle): JsonResponse
    {
        $battle->delete();

        return response()->json([
            'message' => 'Battle deleted successfully'
        ]);
    }

    /**
     * Get battle participants.
     */
    public function participants(Battle $battle): JsonResponse
    {
        $participants = $battle->participants()->paginate(15);
        $nonDirectParticipants = $battle->nonDirectParticipants()->paginate(15);

        return response()->json([
            'direct_participants' => \App\Http\Resources\CharacterResource::collection($participants),
            'non_direct_participants' => \App\Http\Resources\CharacterResource::collection($nonDirectParticipants),
        ]);
    }
}

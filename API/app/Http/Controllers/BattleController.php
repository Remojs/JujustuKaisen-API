<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BattleController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $perPage = min($request->get('per_page', 20), 100);
        $query = Battle::query();

        if ($request->filled('search')) {
            $query->where('event', 'like', '%' . $request->search . '%')
                  ->orWhere('result', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('arc')) {
            $query->where('arc', $request->arc);
        }

        return response()->json($query->paginate($perPage));
    }

    public function getById($id): JsonResponse
    {
        $battle = Battle::find($id);
        if (!$battle) {
            return response()->json(['error' => 'Battle not found'], 404);
        }
        return response()->json($battle);
    }

    public function getByArc($arc): JsonResponse
    {
        return response()->json(Battle::where('arc', $arc)->get());
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'event'                 => 'required|string|max:500',
            'result'                => 'required|string',
            'arc'                   => 'required|string|max:255',
            'date'                  => 'nullable|string|max:100',
            'location'              => 'nullable|string|max:255',
            'location_data'         => 'nullable|integer|exists:locations,id',
            'participants'          => 'nullable|array',
            'nonDirectParticipants' => 'nullable|array',
            'image'                 => 'nullable|string',
        ]);
        return response()->json(Battle::create($validated), 201);
    }
}
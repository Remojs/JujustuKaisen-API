<?php

namespace App\Http\Controllers;

use App\Models\AnimeEpisode;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnimeEpisodeController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $perPage = min($request->get('per_page', 20), 100);
        return response()->json(AnimeEpisode::paginate($perPage));
    }

    public function getById($id): JsonResponse
    {
        $ep = AnimeEpisode::find($id);
        if (!$ep) {
            return response()->json(['error' => 'Episode not found'], 404);
        }
        return response()->json($ep);
    }

    public function getBySeason($season): JsonResponse
    {
        return response()->json(AnimeEpisode::where('season', $season)->get());
    }

    public function getByArc($arcId): JsonResponse
    {
        return response()->json(AnimeEpisode::where('arc', $arcId)->get());
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'episode_number'        => 'required|string',
            'arc'                   => 'required|integer|exists:arcs,id',
            'season'                => 'nullable|string',
            'title'                 => 'required|string|max:255',
            'mangachapters_adapted' => 'nullable|string',
            'air_date'              => 'nullable|string',
            'opening_theme'         => 'nullable|string',
            'ending_theme'          => 'nullable|string',
            'image'                 => 'nullable|string',
        ]);
        return response()->json(AnimeEpisode::create($validated), 201);
    }
}

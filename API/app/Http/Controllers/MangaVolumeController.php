<?php

namespace App\Http\Controllers;

use App\Models\MangaVolume;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MangaVolumeController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(MangaVolume::all());
    }

    public function getById($id): JsonResponse
    {
        $vol = MangaVolume::find($id);
        if (!$vol) {
            return response()->json(['error' => 'Manga volume not found'], 404);
        }
        return response()->json($vol);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'volume_number'   => 'required|string',
            'volume_name'     => 'required|string|max:255',
            'release_date'    => 'nullable|string',
            'pages'           => 'nullable|integer',
            'chapters'        => 'nullable|string',
            'cover_character' => 'nullable|string|max:255',
            'image'           => 'nullable|string',
        ]);
        return response()->json(MangaVolume::create($validated), 201);
    }
}

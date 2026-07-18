<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SpeciesController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Species::all());
    }

    public function getById($id): JsonResponse
    {
        $species = Species::find($id);
        if (!$species) {
            return response()->json(['error' => 'Species not found'], 404);
        }
        return response()->json($species);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'species_name' => 'required|string|max:100',
            'description'  => 'nullable|string',
        ]);
        return response()->json(Species::create($validated), 201);
    }
}

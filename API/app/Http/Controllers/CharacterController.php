<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    /**
     * Get all characters
     */
    public function getAll(): JsonResponse
    {
        $characters = Character::all();
        return response()->json($characters);
    }

    /**
     * Get character by ID
     */
    public function getById($id): JsonResponse
    {
        $character = Character::find($id);

        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        return response()->json($character);
    }

    /**
     * Create a new character
     */
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'alias' => 'nullable|array',
            'speciesId' => 'nullable|integer',
            'birthday' => 'nullable|string',
            'height' => 'nullable|string',
            'age' => 'nullable|string',
            'gender' => 'nullable|integer',
            'occupationId' => 'nullable|array',
            'affiliationId' => 'nullable|array',
            'animeDebut' => 'nullable|string',
            'mangaDebut' => 'nullable|string',
            'cursedTechniquesIds' => 'nullable|array',
            'gradeId' => 'nullable|integer',
            'domainExpansionId' => 'nullable|integer',
            'battlesId' => 'nullable|array',
            'cursedToolId' => 'nullable|array',
            'status' => 'nullable|integer',
            'relatives' => 'nullable|array',
            'image' => 'nullable|string'
        ]);

        // Auto-generate image path if not provided
        if (!isset($validated['image']) && isset($validated['id'])) {
            $validated['image'] = '/Media/Characters/' . $validated['id'] . '.webp';
        }

        $character = Character::create($validated);
        return response()->json($character, 201);
    }
}

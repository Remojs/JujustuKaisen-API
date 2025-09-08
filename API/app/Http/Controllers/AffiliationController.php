<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AffiliationController extends Controller
{
    public function getAll(): JsonResponse
    {
        $affiliations = Affiliation::all();
        return response()->json($affiliations);
    }

    public function getById($id): JsonResponse
    {
        $affiliation = Affiliation::find($id);

        if (!$affiliation) {
            return response()->json(['error' => 'Affiliation not found'], 404);
        }

        return response()->json($affiliation);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'affiliation_name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        // Auto-generate image path if not provided
        if (!$validated['image'] && isset($validated['affiliation_name'])) {
            $validated['image'] = '/Media/Affiliations/' . str_replace(' ', '_', $validated['affiliation_name']) . '.webp';
        }

        $affiliation = Affiliation::create($validated);
        return response()->json($affiliation, 201);
    }
}

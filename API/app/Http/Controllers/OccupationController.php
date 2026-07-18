<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OccupationController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Occupation::all());
    }

    public function getById($id): JsonResponse
    {
        $occ = Occupation::find($id);
        if (!$occ) {
            return response()->json(['error' => 'Occupation not found'], 404);
        }
        return response()->json($occ);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'occupation_name' => 'required|string|max:100',
            'description'     => 'nullable|string',
        ]);
        return response()->json(Occupation::create($validated), 201);
    }
}

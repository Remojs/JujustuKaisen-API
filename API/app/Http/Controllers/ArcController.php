<?php

namespace App\Http\Controllers;

use App\Models\Arc;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArcController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Arc::all());
    }

    public function getById($id): JsonResponse
    {
        $arc = Arc::find($id);
        if (!$arc) {
            return response()->json(['error' => 'Arc not found'], 404);
        }
        return response()->json($arc);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'manga' => 'nullable|string',
            'anime' => 'nullable|array',
            'image' => 'nullable|string',
        ]);
        return response()->json(Arc::create($validated), 201);
    }
}

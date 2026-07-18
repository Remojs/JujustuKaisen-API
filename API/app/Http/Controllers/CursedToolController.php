<?php

namespace App\Http\Controllers;

use App\Models\CursedTool;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CursedToolController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(CursedTool::all());
    }

    public function getById($id): JsonResponse
    {
        $tool = CursedTool::find($id);
        if (!$tool) {
            return response()->json(['error' => 'Cursed tool not found'], 404);
        }
        return response()->json($tool);
    }

    public function getByType($type): JsonResponse
    {
        return response()->json(CursedTool::where('type', $type)->get());
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'owners'      => 'nullable|array',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
        ]);
        return response()->json(CursedTool::create($validated), 201);
    }
}

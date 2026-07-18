<?php

namespace App\Http\Controllers;

use App\Models\CursedTechnique;
use App\Http\Resources\CursedTechniqueResource;
use App\Constants\TechniqueTypeConstants;
use App\Constants\TechniqueRangeConstants;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CursedTechniqueController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $perPage = min($request->get('per_page', 20), 100);
        $query = CursedTechnique::query();

        if ($request->filled('search')) {
            $query->where('technique_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('range')) {
            $query->where('range', $request->range);
        }

        $paginator = $query->paginate($perPage);
        return response()->json(CursedTechniqueResource::collection($paginator)->response()->getData(true));
    }

    public function getById($id): JsonResponse
    {
        $technique = CursedTechnique::find($id);
        if (!$technique) {
            return response()->json(['error' => 'Cursed technique not found'], 404);
        }
        return response()->json(new CursedTechniqueResource($technique));
    }

    public function getByType($type): JsonResponse
    {
        return response()->json(CursedTechniqueResource::collection(CursedTechnique::where('type', $type)->get()));
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'technique_name' => 'required|string|max:255',
            'description'    => 'nullable|string',
            'type'           => 'nullable|integer',
            'range'          => 'nullable|integer',
            'users'          => 'nullable|array',
            'image'          => 'nullable|string',
        ]);
        return response()->json(CursedTechnique::create($validated), 201);
    }
}
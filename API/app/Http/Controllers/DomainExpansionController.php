<?php

namespace App\Http\Controllers;

use App\Models\DomainExpansion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DomainExpansionController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(DomainExpansion::all());
    }

    public function getById($id): JsonResponse
    {
        $de = DomainExpansion::find($id);
        if (!$de) {
            return response()->json(['error' => 'Domain expansion not found'], 404);
        }
        return response()->json($de);
    }

    public function getByUser($userId): JsonResponse
    {
        return response()->json(DomainExpansion::where('user', $userId)->get());
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'user'        => 'required|integer',
            'range'       => 'nullable|string|max:255',
            'Type'        => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
        ]);
        return response()->json(DomainExpansion::create($validated), 201);
    }
}

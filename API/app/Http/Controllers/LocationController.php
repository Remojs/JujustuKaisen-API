<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(Location::all());
    }

    public function getById($id): JsonResponse
    {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['error' => 'Location not found'], 404);
        }
        return response()->json($location);
    }

    public function search(Request $request): JsonResponse
    {
        $q = $request->get('q', '');
        return response()->json(
            Location::where('location_name', 'like', '%' . $q . '%')
                ->orWhere('located_in', 'like', '%' . $q . '%')
                ->get()
        );
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'located_in'    => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'events'        => 'nullable|array',
            'image'         => 'nullable|string',
        ]);
        return response()->json(Location::create($validated), 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Http\Resources\CharacterResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $perPage = min($request->get('per_page', 20), 100);
        $paginator = Character::paginate($perPage);
        return response()->json(CharacterResource::collection($paginator)->response()->getData(true));
    }

    public function getById($id): JsonResponse
    {
        $character = Character::find($id);
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }
        return response()->json(new CharacterResource($character));
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id'                  => 'nullable|integer',
            'name'                => 'required|string|max:255',
            'alias'               => 'nullable|array',
            'speciesId'           => 'nullable|integer',
            'birthday'            => 'nullable|string',
            'height'              => 'nullable|string',
            'age'                 => 'nullable|string',
            'gender'              => 'nullable|integer',
            'occupationId'        => 'nullable|array',
            'affiliationId'       => 'nullable|array',
            'animeDebut'          => 'nullable|string',
            'mangaDebut'          => 'nullable|string',
            'cursedTechniquesIds' => 'nullable|array',
            'gradeId'             => 'nullable|integer',
            'domainExpansionId'   => 'nullable|integer',
            'battlesId'           => 'nullable|array',
            'cursedToolId'        => 'nullable|array',
            'status'              => 'nullable|integer',
            'relatives'           => 'nullable|array',
            'image'               => 'nullable|string',
        ]);

        if (empty($validated['image']) && !empty($validated['id'])) {
            $validated['image'] = '/Media/Characters/' . $validated['id'] . '.webp';
        }

        $character = Character::create($validated);
        return response()->json($character, 201);
    }

    public function getByName(Request $request): JsonResponse
    {
        $name = $request->get('q', '');
        $characters = Character::where('name', 'like', '%' . $name . '%')->get();
        return response()->json(CharacterResource::collection($characters));
    }

    public function getByGender($gender): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('gender', $gender)->get()));
    }

    public function getByStatus($status): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('status', $status)->get()));
    }

    public function getBySpecies($speciesId): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('speciesId', $speciesId)->get()));
    }

    public function getByAffiliation($affiliationId): JsonResponse
    {
        return response()->json(
            CharacterResource::collection(Character::whereJsonContains('affiliationId', (int) $affiliationId)->get())
        );
    }

    public function getByOccupation($occupationId): JsonResponse
    {
        return response()->json(
            CharacterResource::collection(Character::whereJsonContains('occupationId', (int) $occupationId)->get())
        );
    }

    public function getByGrade($gradeId): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('gradeId', $gradeId)->get()));
    }

    public function getByAnimeDebut($episode): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('animeDebut', $episode)->get()));
    }

    public function getByMangaDebut($chapter): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::where('mangaDebut', $chapter)->get()));
    }

    public function getWithDomainExpansion(): JsonResponse
    {
        return response()->json(CharacterResource::collection(Character::whereNotNull('domainExpansionId')->get()));
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $query = Character::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('speciesId')) {
            $query->where('speciesId', $request->speciesId);
        }
        if ($request->filled('gradeId')) {
            $query->where('gradeId', $request->gradeId);
        }
        if ($request->filled('affiliationId')) {
            $query->whereJsonContains('affiliationId', (int) $request->affiliationId);
        }
        if ($request->filled('occupationId')) {
            $query->whereJsonContains('occupationId', (int) $request->occupationId);
        }

        $perPage = min($request->get('per_page', 20), 100);
        $paginator = $query->paginate($perPage);
        return response()->json(CharacterResource::collection($paginator)->response()->getData(true));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CharacterRelationController extends Controller
{
    /**
     * Get character with their species information
     */
    public function getWithSpecies($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        // If you have Species model and relationship set up
        $characterWithSpecies = Character::with('speciesData')->find($id);
        
        return response()->json($characterWithSpecies ?: $character);
    }

    /**
     * Get character with their affiliations
     */
    public function getWithAffiliations($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        // Since affiliationId is JSON array, we need to get related affiliations manually
        $affiliationIds = $character->affiliationId ?? [];
        
        if (!empty($affiliationIds) && class_exists('App\Models\Affiliation')) {
            $affiliations = \App\Models\Affiliation::whereIn('id', $affiliationIds)->get();
            $character->affiliations = $affiliations;
        }
        
        return response()->json($character);
    }

    /**
     * Get character with all their techniques
     */
    public function getWithTechniques($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        $techniqueIds = $character->cursedTechniquesIds ?? [];
        
        if (!empty($techniqueIds) && class_exists('App\Models\CursedTechnique')) {
            $techniques = \App\Models\CursedTechnique::whereIn('id', $techniqueIds)->get();
            $character->cursedTechniques = $techniques;
        }
        
        return response()->json($character);
    }

    /**
     * Get character with all battles they participated in
     */
    public function getWithBattles($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        $battleIds = $character->battlesId ?? [];
        
        if (!empty($battleIds) && class_exists('App\Models\Battle')) {
            $battles = \App\Models\Battle::whereIn('id', $battleIds)->get();
            $character->battles = $battles;
        }
        
        return response()->json($character);
    }

    /**
     * Get full character profile with all relationships
     */
    public function getFullProfile($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        // Add species
        if ($character->speciesId && class_exists('App\Models\Species')) {
            $character->species = \App\Models\Species::find($character->speciesId);
        }

        // Add affiliations
        $affiliationIds = $character->affiliationId ?? [];
        if (!empty($affiliationIds) && class_exists('App\Models\Affiliation')) {
            $character->affiliations = \App\Models\Affiliation::whereIn('id', $affiliationIds)->get();
        }

        // Add occupations
        $occupationIds = $character->occupationId ?? [];
        if (!empty($occupationIds) && class_exists('App\Models\Occupation')) {
            $character->occupations = \App\Models\Occupation::whereIn('id', $occupationIds)->get();
        }

        // Add cursed techniques
        $techniqueIds = $character->cursedTechniquesIds ?? [];
        if (!empty($techniqueIds) && class_exists('App\Models\CursedTechnique')) {
            $character->cursedTechniques = \App\Models\CursedTechnique::whereIn('id', $techniqueIds)->get();
        }

        // Add domain expansion
        if ($character->domainExpansionId && class_exists('App\Models\DomainExpansion')) {
            $character->domainExpansion = \App\Models\DomainExpansion::find($character->domainExpansionId);
        }

        // Add battles
        $battleIds = $character->battlesId ?? [];
        if (!empty($battleIds) && class_exists('App\Models\Battle')) {
            $character->battles = \App\Models\Battle::whereIn('id', $battleIds)->get();
        }

        // Add cursed tools
        $toolIds = $character->cursedToolId ?? [];
        if (!empty($toolIds) && class_exists('App\Models\CursedTool')) {
            $character->cursedTools = \App\Models\CursedTool::whereIn('id', $toolIds)->get();
        }

        return response()->json($character);
    }

    /**
     * Get character statistics and counts
     */
    public function getStats($id): JsonResponse
    {
        $character = Character::find($id);
        
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }

        $stats = [
            'character_id' => $character->id,
            'character_name' => $character->name,
            'total_aliases' => count($character->alias ?? []),
            'total_affiliations' => count($character->affiliationId ?? []),
            'total_occupations' => count($character->occupationId ?? []),
            'total_cursed_techniques' => count($character->cursedTechniquesIds ?? []),
            'total_battles' => count($character->battlesId ?? []),
            'total_cursed_tools' => count($character->cursedToolId ?? []),
            'has_domain_expansion' => !is_null($character->domainExpansionId),
            'total_relatives' => count($character->relatives ?? [])
        ];

        return response()->json($stats);
    }
}
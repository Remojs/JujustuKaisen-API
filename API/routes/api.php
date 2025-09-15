<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterRelationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes - Information Retrieval & Data Insertion Only
Route::prefix('v1')->group(function () {
    
    // Characters - Basic CRUD
    Route::get('characters', [CharacterController::class, 'getAll']);
    Route::get('characters/{id}', [CharacterController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('characters', [CharacterController::class, 'create']);
    
    // Characters - Advanced Search & Filters
    Route::get('characters/search/name', [CharacterController::class, 'getByName']);
    Route::get('characters/filter/gender/{gender}', [CharacterController::class, 'getByGender']);
    Route::get('characters/filter/status/{status}', [CharacterController::class, 'getByStatus']);
    Route::get('characters/filter/species/{speciesId}', [CharacterController::class, 'getBySpecies']);
    Route::get('characters/filter/affiliation/{affiliationId}', [CharacterController::class, 'getByAffiliation']);
    Route::get('characters/filter/occupation/{occupationId}', [CharacterController::class, 'getByOccupation']);
    Route::get('characters/filter/grade/{gradeId}', [CharacterController::class, 'getByGrade']);
    Route::get('characters/filter/anime-debut/{episode}', [CharacterController::class, 'getByAnimeDebut']);
    Route::get('characters/filter/manga-debut/{chapter}', [CharacterController::class, 'getByMangaDebut']);
    Route::get('characters/domain-expansion', [CharacterController::class, 'getWithDomainExpansion']);
    Route::get('characters/filter', [CharacterController::class, 'getFiltered']);
    
    // Characters - Relationships & Full Profiles
    Route::get('characters/{id}/with-species', [CharacterRelationController::class, 'getWithSpecies']);
    Route::get('characters/{id}/with-affiliations', [CharacterRelationController::class, 'getWithAffiliations']);
    Route::get('characters/{id}/with-techniques', [CharacterRelationController::class, 'getWithTechniques']);
    Route::get('characters/{id}/with-battles', [CharacterRelationController::class, 'getWithBattles']);
    Route::get('characters/{id}/full-profile', [CharacterRelationController::class, 'getFullProfile']);
    Route::get('characters/{id}/stats', [CharacterRelationController::class, 'getStats']);
    
});

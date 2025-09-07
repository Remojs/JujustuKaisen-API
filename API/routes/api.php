<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\CursedTechniqueController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ArcController;
use App\Http\Controllers\AnimeEpisodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes
Route::prefix('v1')->group(function () {
    
    // Characters
    Route::apiResource('characters', CharacterController::class);
    Route::get('characters/{character}/battles', [CharacterController::class, 'battles']);
    Route::get('characters/filters/options', [CharacterController::class, 'filters']);
    
    // Battles
    Route::apiResource('battles', BattleController::class);
    Route::get('battles/{battle}/participants', [BattleController::class, 'participants']);
    
    // Cursed Techniques
    Route::apiResource('cursed-techniques', CursedTechniqueController::class);
    Route::get('cursed-techniques/{cursedTechnique}/users', [CursedTechniqueController::class, 'users']);
    Route::get('cursed-techniques/filters/options', [CursedTechniqueController::class, 'filters']);
    
    // Locations
    Route::apiResource('locations', LocationController::class);
    
    // Arcs
    Route::apiResource('arcs', ArcController::class);
    
    // Anime Episodes
    Route::apiResource('anime-episodes', AnimeEpisodeController::class);
    
    // Health check
    Route::get('health', function () {
        return response()->json([
            'status' => 'ok',
            'message' => 'JJK API is running',
            'version' => 'v1',
            'timestamp' => now()->toISOString()
        ]);
    });
});

// Root API info
Route::get('/', function () {
    return response()->json([
        'name' => 'Jujutsu Kaisen API',
        'description' => 'A comprehensive API for Jujutsu Kaisen characters, battles, techniques, and more',
        'version' => 'v1',
        'documentation' => url('/docs'),
        'endpoints' => [
            'characters' => url('/api/v1/characters'),
            'battles' => url('/api/v1/battles'),
            'cursed_techniques' => url('/api/v1/cursed-techniques'),
            'locations' => url('/api/v1/locations'),
            'arcs' => url('/api/v1/arcs'),
            'anime_episodes' => url('/api/v1/anime-episodes'),
        ]
    ]);
});

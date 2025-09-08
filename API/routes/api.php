<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes - Information Retrieval & Data Insertion Only
Route::prefix('v1')->group(function () {
    
    // Characters
    Route::get('characters', [CharacterController::class, 'getAll']);
    Route::get('characters/{id}', [CharacterController::class, 'getById']);
    Route::post('characters', [CharacterController::class, 'create']);
    
});

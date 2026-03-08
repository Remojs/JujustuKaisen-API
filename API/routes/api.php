<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterRelationController;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ArcController;
use App\Http\Controllers\AnimeEpisodeController;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\CursedTechniqueController;
use App\Http\Controllers\CursedToolController;
use App\Http\Controllers\DomainExpansionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MangaVolumeController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\SpeciesController;

Route::prefix('v1')->group(function () {

    // ─── CHARACTERS ──────────────────────────────────────────────────────────
    Route::get('characters',                          [CharacterController::class, 'getAll']);
    Route::get('characters/search',                   [CharacterController::class, 'getByName']);
    Route::get('characters/filter',                   [CharacterController::class, 'getFiltered']);
    Route::get('characters/with-domain-expansion',    [CharacterController::class, 'getWithDomainExpansion']);
    Route::get('characters/filter/gender/{gender}',   [CharacterController::class, 'getByGender']);
    Route::get('characters/filter/status/{status}',   [CharacterController::class, 'getByStatus']);
    Route::get('characters/filter/species/{speciesId}',[CharacterController::class, 'getBySpecies']);
    Route::get('characters/filter/grade/{gradeId}',   [CharacterController::class, 'getByGrade']);
    Route::get('characters/filter/affiliation/{affiliationId}', [CharacterController::class, 'getByAffiliation']);
    Route::get('characters/filter/occupation/{occupationId}',   [CharacterController::class, 'getByOccupation']);
    Route::get('characters/filter/anime-debut/{episode}',       [CharacterController::class, 'getByAnimeDebut']);
    Route::get('characters/filter/manga-debut/{chapter}',       [CharacterController::class, 'getByMangaDebut']);
    Route::get('characters/{id}',                     [CharacterController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('characters',                         [CharacterController::class, 'create']);

    // Characters – relaciones expandidas
    Route::get('characters/{id}/species',        [CharacterRelationController::class, 'getWithSpecies'])->where('id', '[0-9]+');
    Route::get('characters/{id}/affiliations',   [CharacterRelationController::class, 'getWithAffiliations'])->where('id', '[0-9]+');
    Route::get('characters/{id}/techniques',     [CharacterRelationController::class, 'getWithTechniques'])->where('id', '[0-9]+');
    Route::get('characters/{id}/battles',        [CharacterRelationController::class, 'getWithBattles'])->where('id', '[0-9]+');
    Route::get('characters/{id}/full-profile',   [CharacterRelationController::class, 'getFullProfile'])->where('id', '[0-9]+');
    Route::get('characters/{id}/stats',          [CharacterRelationController::class, 'getStats'])->where('id', '[0-9]+');

    // ─── AFFILIATIONS ─────────────────────────────────────────────────────────
    Route::get('affiliations',        [AffiliationController::class, 'getAll']);
    Route::get('affiliations/{id}',   [AffiliationController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('affiliations',       [AffiliationController::class, 'create']);

    // ─── CURSED TECHNIQUES ───────────────────────────────────────────────────
    Route::get('cursed-techniques',                   [CursedTechniqueController::class, 'getAll']);
    Route::get('cursed-techniques/search',            [CursedTechniqueController::class, 'getAll']);
    Route::get('cursed-techniques/filter/type/{type}',[CursedTechniqueController::class, 'getByType']);
    Route::get('cursed-techniques/{id}',              [CursedTechniqueController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('cursed-techniques',                  [CursedTechniqueController::class, 'create']);

    // ─── CURSED TOOLS ─────────────────────────────────────────────────────────
    Route::get('cursed-tools',                        [CursedToolController::class, 'getAll']);
    Route::get('cursed-tools/filter/type/{type}',     [CursedToolController::class, 'getByType']);
    Route::get('cursed-tools/{id}',                   [CursedToolController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('cursed-tools',                       [CursedToolController::class, 'create']);

    // ─── DOMAIN EXPANSIONS ───────────────────────────────────────────────────
    Route::get('domain-expansions',                          [DomainExpansionController::class, 'getAll']);
    Route::get('domain-expansions/user/{userId}',            [DomainExpansionController::class, 'getByUser'])->where('userId', '[0-9]+');
    Route::get('domain-expansions/{id}',                     [DomainExpansionController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('domain-expansions',                         [DomainExpansionController::class, 'create']);

    // ─── BATTLES ─────────────────────────────────────────────────────────────
    Route::get('battles',                        [BattleController::class, 'getAll']);
    Route::get('battles/filter/arc/{arc}',       [BattleController::class, 'getByArc']);
    Route::get('battles/{id}',                   [BattleController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('battles',                       [BattleController::class, 'create']);

    // ─── LOCATIONS ───────────────────────────────────────────────────────────
    Route::get('locations',          [LocationController::class, 'getAll']);
    Route::get('locations/search',   [LocationController::class, 'search']);
    Route::get('locations/{id}',     [LocationController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('locations',         [LocationController::class, 'create']);

    // ─── ARCS ─────────────────────────────────────────────────────────────────
    Route::get('arcs',          [ArcController::class, 'getAll']);
    Route::get('arcs/{id}',     [ArcController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('arcs',         [ArcController::class, 'create']);

    // ─── ANIME EPISODES ──────────────────────────────────────────────────────
    Route::get('anime-episodes',                        [AnimeEpisodeController::class, 'getAll']);
    Route::get('anime-episodes/filter/season/{season}', [AnimeEpisodeController::class, 'getBySeason']);
    Route::get('anime-episodes/filter/arc/{arcId}',     [AnimeEpisodeController::class, 'getByArc'])->where('arcId', '[0-9]+');
    Route::get('anime-episodes/{id}',                   [AnimeEpisodeController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('anime-episodes',                       [AnimeEpisodeController::class, 'create']);

    // ─── MANGA VOLUMES ───────────────────────────────────────────────────────
    Route::get('manga-volumes',       [MangaVolumeController::class, 'getAll']);
    Route::get('manga-volumes/{id}',  [MangaVolumeController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('manga-volumes',      [MangaVolumeController::class, 'create']);

    // ─── SPECIES ─────────────────────────────────────────────────────────────
    Route::get('species',      [SpeciesController::class, 'getAll']);
    Route::get('species/{id}', [SpeciesController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('species',     [SpeciesController::class, 'create']);

    // ─── OCCUPATIONS ─────────────────────────────────────────────────────────
    Route::get('occupations',      [OccupationController::class, 'getAll']);
    Route::get('occupations/{id}', [OccupationController::class, 'getById'])->where('id', '[0-9]+');
    Route::post('occupations',     [OccupationController::class, 'create']);

});

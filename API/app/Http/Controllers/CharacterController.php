<?php<?php<?php



namespace App\Http\Controllers;



use App\Models\Character;namespace App\Http\Controllers;namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;



class CharacterController extends Controlleruse App\Models\Character;use App\Models\Character;

{

    /**use Illuminate\Http\Request;use Illuminate\Http\Request;

     * Get all characters

     */use Illuminate\Http\JsonResponse;use Illuminate\Http\JsonResponse;

    public function getAll(): JsonResponse

    {

        $characters = Character::all();

        return response()->json($characters);class CharacterController extends Controllerclass CharacterController extends Controller

    }

{{

    /**

     * Get character by ID    /**    /**

     */

    public function getById($id): JsonResponse     * Get all characters     * Get all char    /**

    {

        $character = Character::find($id);     */     * Get characters by species ID



        if (!$character) {    public function getAll(): JsonResponse     */

            return response()->json(['error' => 'Character not found'], 404);

        }    {    public function getBySpecies($speciesId): JsonResponse



        return response()->json($character);        $characters = Character::all();    {

    }

        return response()->json($characters);        $characters = Character::where('speciesId', $speciesId)->get();

    /**

     * Create a new character    }        return response()->json($characters);

     */

    public function create(Request $request): JsonResponse    }

    {

        $validated = $request->validate([    /**

            'id' => 'nullable|integer',

            'name' => 'required|string',     * Get character by ID    /**

            'alias' => 'nullable|array',

            'speciesId' => 'nullable|integer',     */     * Get characters by gender (1=male, 2=female, 3=genderless)

            'birthday' => 'nullable|string',

            'height' => 'nullable|string',    public function getById($id): JsonResponse     */

            'age' => 'nullable|string',

            'gender' => 'nullable|integer',    {    public function getByGender($gender): JsonResponse

            'occupationId' => 'nullable|array',

            'affiliationId' => 'nullable|array',        $character = Character::find($id);    {

            'animeDebut' => 'nullable|string',

            'mangaDebut' => 'nullable|string',        $characters = Character::where('gender', $gender)->get();

            'cursedTechniquesIds' => 'nullable|array',

            'gradeId' => 'nullable|integer',        if (!$character) {        return response()->json($characters);

            'domainExpansionId' => 'nullable|integer',

            'battlesId' => 'nullable|array',            return response()->json(['error' => 'Character not found'], 404);    }

            'cursedToolId' => 'nullable|array',

            'status' => 'nullable|integer',        }

            'relatives' => 'nullable|array',

            'image' => 'nullable|string'    /**

        ]);

        return response()->json($character);     * Get characters by status (1=alive, 2=dead, 3=unknown)

        if (!isset($validated['image']) && isset($validated['id'])) {

            $validated['image'] = '/Media/Characters/' . $validated['id'] . '.webp';    }     */

        }

    public function getByStatus($status): JsonResponse

        $character = Character::create($validated);

        return response()->json($character, 201);    /**    {

    }

     * Create a new character        $characters = Character::where('status', $status)->get();

    /**

     * Get characters by species ID     */        return response()->json($characters);

     */

    public function getBySpecies($speciesId): JsonResponse    public function create(Request $request): JsonResponse    }

    {

        $characters = Character::where('speciesId', $speciesId)->get();    {

        return response()->json($characters);

    }        $validated = $request->validate([    /**



    /**            'id' => 'nullable|integer',     * Get characters by affiliation ID

     * Get characters by gender (1=male, 2=female, 3=genderless)

     */            'name' => 'required|string',     */

    public function getByGender($gender): JsonResponse

    {            'alias' => 'nullable|array',    public function getByAffiliation($affiliationId): JsonResponse

        $characters = Character::where('gender', $gender)->get();

        return response()->json($characters);            'speciesId' => 'nullable|integer',    {

    }

            'birthday' => 'nullable|string',        $characters = Character::whereJsonContains('affiliationId', $affiliationId)->get();

    /**

     * Get characters by status (1=alive, 2=dead, 3=unknown)            'height' => 'nullable|string',        return response()->json($characters);

     */

    public function getByStatus($status): JsonResponse            'age' => 'nullable|string',    }

    {

        $characters = Character::where('status', $status)->get();            'gender' => 'nullable|integer',

        return response()->json($characters);

    }            'occupationId' => 'nullable|array',    /**



    /**            'affiliationId' => 'nullable|array',     * Get characters by grade ID

     * Get characters by affiliation ID

     */            'animeDebut' => 'nullable|string',     */

    public function getByAffiliation($affiliationId): JsonResponse

    {            'mangaDebut' => 'nullable|string',    public function getByGrade($gradeId): JsonResponse

        $characters = Character::whereJsonContains('affiliationId', $affiliationId)->get();

        return response()->json($characters);            'cursedTechniquesIds' => 'nullable|array',    {

    }

            'gradeId' => 'nullable|integer',        $characters = Character::where('gradeId', $gradeId)->get();

    /**

     * Get characters by grade ID            'domainExpansionId' => 'nullable|integer',        return response()->json($characters);

     */

    public function getByGrade($gradeId): JsonResponse            'battlesId' => 'nullable|array',    }

    {

        $characters = Character::where('gradeId', $gradeId)->get();            'cursedToolId' => 'nullable|array',

        return response()->json($characters);

    }            'status' => 'nullable|integer',    /**



    /**            'relatives' => 'nullable|array',     * Get characters by occupation ID

     * Get characters by occupation ID

     */            'image' => 'nullable|string'     */

    public function getByOccupation($occupationId): JsonResponse

    {        ]);    public function getByOccupation($occupationId): JsonResponse

        $characters = Character::whereJsonContains('occupationId', $occupationId)->get();

        return response()->json($characters);    {

    }

        // Auto-generate image path if not provided        $characters = Character::whereJsonContains('occupationId', $occupationId)->get();

    /**

     * Search characters by name (partial match)        if (!isset($validated['image']) && isset($validated['id'])) {        return response()->json($characters);

     */

    public function searchByName($name): JsonResponse            $validated['image'] = '/Media/Characters/' . $validated['id'] . '.webp';    }

    {

        $characters = Character::where('name', 'LIKE', "%{$name}%")        }

                               ->orWhereJsonContains('alias', $name)

                               ->get();    /**

        return response()->json($characters);

    }        $character = Character::create($validated);     * Search characters by name (partial match)



    /**        return response()->json($character, 201);     */

     * Get characters who have domain expansion

     */    }    public function searchByName($name): JsonResponse

    public function getWithDomainExpansion(): JsonResponse

    {    {

        $characters = Character::whereNotNull('domainExpansionId')->get();

        return response()->json($characters);    /**        $characters = Character::where('name', 'LIKE', "%{$name}%")

    }

     * Get characters by species ID                               ->orWhereJsonContains('alias', $name)

    /**

     * Get characters by age range     */                               ->get();

     */

    public function getByAgeRange($minAge, $maxAge): JsonResponse    public function getBySpecies($speciesId): JsonResponse        return response()->json($characters);

    {

        $characters = Character::whereBetween('age', [$minAge, $maxAge])->get();    {    }

        return response()->json($characters);

    }        $characters = Character::where('speciesId', $speciesId)->get();



    /**        return response()->json($characters);    /**

     * Get characters who participated in battles

     */    }     * Get characters who have domain expansion

    public function getWithBattles(): JsonResponse

    {     */

        $characters = Character::whereNotNull('battlesId')->get();

        return response()->json($characters);    /**    public function getWithDomainExpansion(): JsonResponse

    }

     * Get characters by gender (1=male, 2=female, 3=genderless)    {

    /**

     * Get characters with cursed techniques     */        $characters = Character::whereNotNull('domainExpansionId')->get();

     */

    public function getWithCursedTechniques(): JsonResponse    public function getByGender($gender): JsonResponse        return response()->json($characters);

    {

        $characters = Character::whereNotNull('cursedTechniquesIds')->get();    {    }

        return response()->json($characters);

    }        $characters = Character::where('gender', $gender)->get();



    /**        return response()->json($characters);    /**

     * Advanced search with multiple filters

     */    }     * Get characters by age range

    public function advancedSearch(Request $request): JsonResponse

    {     */

        $query = Character::query();

    /**    public function getByAgeRange($minAge, $maxAge): JsonResponse

        if ($request->has('name')) {

            $query->where('name', 'LIKE', "%{$request->name}%");     * Get characters by status (1=alive, 2=dead, 3=unknown)    {

        }

     */        $characters = Character::whereBetween('age', [$minAge, $maxAge])->get();

        if ($request->has('gender')) {

            $query->where('gender', $request->gender);    public function getByStatus($status): JsonResponse        return response()->json($characters);

        }

    {    }

        if ($request->has('status')) {

            $query->where('status', $request->status);        $characters = Character::where('status', $status)->get();

        }

        return response()->json($characters);    /**

        if ($request->has('speciesId')) {

            $query->where('speciesId', $request->speciesId);    }     * Get characters who participated in battles

        }

     */

        if ($request->has('gradeId')) {

            $query->where('gradeId', $request->gradeId);    /**    public function getWithBattles(): JsonResponse

        }

     * Get characters by affiliation ID    {

        if ($request->has('affiliationId')) {

            $query->whereJsonContains('affiliationId', $request->affiliationId);     */        $characters = Character::whereNotNull('battlesId')->get();

        }

    public function getByAffiliation($affiliationId): JsonResponse        return response()->json($characters);

        if ($request->has('hasDebutAnime')) {

            $query->whereNotNull('animeDebut');    {    }

        }

        $characters = Character::whereJsonContains('affiliationId', $affiliationId)->get();

        if ($request->has('hasDebutManga')) {

            $query->whereNotNull('mangaDebut');        return response()->json($characters);    /**

        }

    }     * Get characters with cursed techniques

        $characters = $query->get();

        return response()->json($characters);     */

    }

}    /**    public function getWithCursedTechniques(): JsonResponse

     * Get characters by grade ID    {

     */        $characters = Character::whereNotNull('cursedTechniquesIds')->get();

    public function getByGrade($gradeId): JsonResponse        return response()->json($characters);

    {    }

        $characters = Character::where('gradeId', $gradeId)->get();

        return response()->json($characters);    /**

    }     * Advanced search with multiple filters

     */

    /**    public function advancedSearch(Request $request): JsonResponse

     * Get characters by occupation ID    {

     */        $query = Character::query();

    public function getByOccupation($occupationId): JsonResponse

    {        if ($request->has('name')) {

        $characters = Character::whereJsonContains('occupationId', $occupationId)->get();            $query->where('name', 'LIKE', "%{$request->name}%");

        return response()->json($characters);        }

    }

        if ($request->has('gender')) {

    /**            $query->where('gender', $request->gender);

     * Search characters by name (partial match)        }

     */

    public function searchByName($name): JsonResponse        if ($request->has('status')) {

    {            $query->where('status', $request->status);

        $characters = Character::where('name', 'LIKE', "%{$name}%")        }

                               ->orWhereJsonContains('alias', $name)

                               ->get();        if ($request->has('speciesId')) {

        return response()->json($characters);            $query->where('speciesId', $request->speciesId);

    }        }



    /**        if ($request->has('gradeId')) {

     * Get characters who have domain expansion            $query->where('gradeId', $request->gradeId);

     */        }

    public function getWithDomainExpansion(): JsonResponse

    {        if ($request->has('affiliationId')) {

        $characters = Character::whereNotNull('domainExpansionId')->get();            $query->whereJsonContains('affiliationId', $request->affiliationId);

        return response()->json($characters);        }

    }

        if ($request->has('hasDebutAnime')) {

    /**            $query->whereNotNull('animeDebut');

     * Get characters by age range        }

     */

    public function getByAgeRange($minAge, $maxAge): JsonResponse        if ($request->has('hasDebutManga')) {

    {            $query->whereNotNull('mangaDebut');

        $characters = Character::whereBetween('age', [$minAge, $maxAge])->get();        }

        return response()->json($characters);

    }        $characters = $query->get();

        return response()->json($characters);

    /**    }

     * Get characters who participated in battles}

     */    public function getAll(): JsonResponse

    public function getWithBattles(): JsonResponse    {

    {        $characters = Character::all();

        $characters = Character::whereNotNull('battlesId')->get();        return response()->json($characters);

        return response()->json($characters);    }

    }

    /**

    /**     * Get character by ID

     * Get characters with cursed techniques     */

     */    public function getById($id): JsonResponse

    public function getWithCursedTechniques(): JsonResponse    {

    {        $character = Character::find($id);

        $characters = Character::whereNotNull('cursedTechniquesIds')->get();

        return response()->json($characters);        if (!$character) {

    }            return response()->json(['error' => 'Character not found'], 404);

        }

    /**

     * Advanced search with multiple filters        return response()->json($character);

     */    }

    public function advancedSearch(Request $request): JsonResponse

    {    /**

        $query = Character::query();     * Create a new character

     */

        if ($request->has('name')) {    public function create(Request $request): JsonResponse

            $query->where('name', 'LIKE', "%{$request->name}%");    {

        }        $validated = $request->validate([

            'id' => 'nullable|integer',

        if ($request->has('gender')) {            'name' => 'required|string',

            $query->where('gender', $request->gender);            'alias' => 'nullable|array',

        }            'speciesId' => 'nullable|integer',

            'birthday' => 'nullable|string',

        if ($request->has('status')) {            'height' => 'nullable|string',

            $query->where('status', $request->status);            'age' => 'nullable|string',

        }            'gender' => 'nullable|integer',

            'occupationId' => 'nullable|array',

        if ($request->has('speciesId')) {            'affiliationId' => 'nullable|array',

            $query->where('speciesId', $request->speciesId);            'animeDebut' => 'nullable|string',

        }            'mangaDebut' => 'nullable|string',

            'cursedTechniquesIds' => 'nullable|array',

        if ($request->has('gradeId')) {            'gradeId' => 'nullable|integer',

            $query->where('gradeId', $request->gradeId);            'domainExpansionId' => 'nullable|integer',

        }            'battlesId' => 'nullable|array',

            'cursedToolId' => 'nullable|array',

        if ($request->has('affiliationId')) {            'status' => 'nullable|integer',

            $query->whereJsonContains('affiliationId', $request->affiliationId);            'relatives' => 'nullable|array',

        }            'image' => 'nullable|string'

        ]);

        if ($request->has('hasDebutAnime')) {

            $query->whereNotNull('animeDebut');        // Auto-generate image path if not provided

        }        if (!isset($validated['image']) && isset($validated['id'])) {

            $validated['image'] = '/Media/Characters/' . $validated['id'] . '.webp';

        if ($request->has('hasDebutManga')) {        }

            $query->whereNotNull('mangaDebut');

        }        $character = Character::create($validated);

        return response()->json($character, 201);

        $characters = $query->get();    }

        return response()->json($characters);

    }    /**

}     * Get characters by name (search)
     */
    public function getByName(Request $request): JsonResponse
    {
        $name = $request->query('name');
        
        if (!$name) {
            return response()->json(['error' => 'Name parameter is required'], 400);
        }

        $characters = Character::where('name', 'LIKE', '%' . $name . '%')->get();
        
        return response()->json($characters);
    }

    /**
     * Get characters by gender
     */
    public function getByGender($gender): JsonResponse
    {
        $characters = Character::where('gender', $gender)->get();
        return response()->json($characters);
    }

    /**
     * Get characters by status
     */
    public function getByStatus($status): JsonResponse
    {
        $characters = Character::where('status', $status)->get();
        return response()->json($characters);
    }

    /**
     * Get characters by species
     */
    public function getBySpecies($speciesId): JsonResponse
    {
        $characters = Character::where('speciesId', $speciesId)->get();
        return response()->json($characters);
    }

    /**
     * Get characters by affiliation
     */
    public function getByAffiliation($affiliationId): JsonResponse
    {
        $characters = Character::whereJsonContains('affiliationId', $affiliationId)->get();
        return response()->json($characters);
    }

    /**
     * Get characters by occupation
     */
    public function getByOccupation($occupationId): JsonResponse
    {
        $characters = Character::whereJsonContains('occupationId', $occupationId)->get();
        return response()->json($characters);
    }

    /**
     * Get characters by grade
     */
    public function getByGrade($gradeId): JsonResponse
    {
        $characters = Character::where('gradeId', $gradeId)->get();
        return response()->json($characters);
    }

    /**
     * Get characters that have domain expansion
     */
    public function getWithDomainExpansion(): JsonResponse
    {
        $characters = Character::whereNotNull('domainExpansionId')->get();
        return response()->json($characters);
    }

    /**
     * Get characters that appear in specific anime debut
     */
    public function getByAnimeDebut($episode): JsonResponse
    {
        $characters = Character::where('animeDebut', 'LIKE', '%' . $episode . '%')->get();
        return response()->json($characters);
    }

    /**
     * Get characters that appear in specific manga debut
     */
    public function getByMangaDebut($chapter): JsonResponse
    {
        $characters = Character::where('mangaDebut', 'LIKE', '%' . $chapter . '%')->get();
        return response()->json($characters);
    }

    /**
     * Get characters with advanced filters
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $query = Character::query();

        // Filter by name
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by gender
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by species
        if ($request->has('speciesId')) {
            $query->where('speciesId', $request->speciesId);
        }

        // Filter by grade
        if ($request->has('gradeId')) {
            $query->where('gradeId', $request->gradeId);
        }

        // Filter by affiliation (JSON array)
        if ($request->has('affiliationId')) {
            $query->whereJsonContains('affiliationId', (int)$request->affiliationId);
        }

        // Filter by occupation (JSON array)
        if ($request->has('occupationId')) {
            $query->whereJsonContains('occupationId', (int)$request->occupationId);
        }

        // Filter characters with domain expansion
        if ($request->has('hasDomainExpansion') && $request->hasDomainExpansion === 'true') {
            $query->whereNotNull('domainExpansionId');
        }

        $characters = $query->get();
        return response()->json($characters);
    }
}

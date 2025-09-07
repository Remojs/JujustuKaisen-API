Esta API maneja un ecosistema complejo de datos del universo Jujutsu Kaisen con **CHARACTERS** como tabla central y múltiples relaciones hacia entidades secundarias y tablas de soporte estático.

## 🏗️ Arquitectura de Datos

### TABLA CENTRAL: CHARACTERS
La tabla `CHARACTERS` es el núcleo del sistema y mantiene las siguientes relaciones:

**Relaciones Dinámicas (Muchos a Muchos / Uno a Muchos):**
- `cursedToolId` → CursedTools (0 a N relaciones)
- `battlesId` → Battles (0 a N relaciones)  
- `domainExpansionId` → DomainExpansions (0 a 1 relación)
- `cursedTechniquesIds` → CursedTechniques (0 a N relaciones)
- `affiliationId` → Affiliations (0 a N relaciones)

**Referencias Estáticas (Claves Foráneas):**
- `speciesId` → Species (0 a 1)
- `gender` → Gender (0 a 1)
- `gradeId` → Grades (0 a 1)
- `status` → Status (0 a 1)
- `occupationId` → Occupations (0 a N)

**Estructura de Ejemplo (Campos Reales):**
```json
{
  "id": 1,
  "name": "Yuji Itadori",
  "alias": ["Sukuna's Vessel", "Tiger of West Jr High", "Yuu-chan", "Brat", "Brother"],
  "speciesId": 1,
  "birthday": "March 20",
  "height": "173 cm", 
  "age": "15",
  "gender": 1,
  "occupationId": [1, 4, 15],
  "affiliationId": [1],
  "animeDebut": "Ep1",
  "mangaDebut": "Ch1", 
  "cursedTechniquesIds": [51, 52, 56, 67, 68, 71, 77, 78, 79],
  "gradeId": 4,
  "domainExpansionId": 13,
  "battlesId": [14, 15, 16, 17, 18, 20, 23, 26, 28, 29, 30, 31, 32, 39, 40, 42, 45, 48, 50, 54, 60, 61, 62, 64, 65, 67, 69, 74, 75, 88, 97, 98, 100, 101, 102, 103, 104, 105],
  "cursedToolId": [7],
  "status": 1,
  "relatives": ["Kaori Itadori (Mother)", "Jin Itadori (Father)", "Wasuke Itadori (Grandfather)", "Choso (Older Half-Brother)", "..."],
  "image": "/characters/1.webp"
}
```

---

## 🔗 Tablas Relacionales Secundarias

### 1. AffiliationsTable
- **Propósito**: Organizaciones, clanes, escuelas
- **Relación Saliente**: `controlled_by` → Characters (0 a 1)
- **Estructura**:
```json
{
  "id": 1,
  "affiliation_name": "Tokyo Jujutsu High",
  "type": "Jujutsu School",
  "controlled_by": 9,
  "location": "Tokyo Prefecture"
}
```

### 2. BattlesTable  
- **Propósito**: Combates y enfrentamientos
- **Relaciones Salientes**:
  - `location_data` → Locations (0 a 1)
  - `participants` → Characters (0 a N)
  - `nonDirectParticipants` → Characters (0 a N)
- **Estructura Real**:
```json
{
  "id": 1,
  "event": "Satoru Gojo & Suguru Geto vs. Bayer & Kokun",
  "result": "Gojo and Geto are victorious. Bayer & Kokun are defeated. Riko is Rescued",
  "arc": "Gojo Past Arc",
  "date": "August 2006",
  "location": "Outside Riko Amanai's house",
  "location_data": 33,
  "participants": [4, 14, 111, 112],
  "nonDirectParticipants": [71, 72, 141, 142, 143],
  "image": "/battles/1.webp"
}
```

### 3. CursedTechniques
- **Propósito**: Técnicas de maldición
- **Referencias Estáticas**: `type`, `range` → TechniqueTypes, TechniqueRanges
- **Relación Saliente**: `users` → Characters (0 a N)
- **Estructura Real**:
```json
{
  "id": 1,
  "technique_name": "Boogie Woogie",
  "description": "Allows him to switch the positions of anything with cursed energy within his range with a clap of his hands.",
  "type": 1,
  "range": 2,
  "users": [30],
  "image": "/cursedTechnique/1.webp"
}
```

### 4. CursedTools
- **Propósito**: Herramientas y armas malditas  
- **Relación Saliente**: `owners` → Characters (0 a N)
- **Estructura Real**:
```json
{
  "id": 1,
  "name": "Inverted Spear of Heaven",
  "type": "Cursed Tool",
  "owners": [28],
  "description": "Nullifies any cursed technique upon impalement.",
  "image": "/cursedTool/1.webp"
}
```

### 5. DomainExpansions
- **Propósito**: Expansiones de dominio
- **Relación Saliente**: `user` → Characters (1 usuario por dominio)
- **Estructura Real**:
```json
{
  "id": 1,
  "name": "Unlimited Void",
  "user": 4,
  "range": "Enclosed barrier (surrounding area)",
  "Type": "Domain Expansion",
  "description": "Traps targets in an infinite void space that overwhelms them with endless information, rendering them completely immobile.",
  "image": "/domainExpansions/1.webp"
}
```

### 6. LocationsTable
- **Propósito**: Lugares y ubicaciones
- **Relación Saliente**: `events` → Battles (0 a N)
- **Estructura Real**:
```json
{
  "id": 1, 
  "location_name": "Tokyo Jujutsu High",
  "located_in": "Tokyo",
  "description": "One of Japan's two main jujutsu schools, dedicated to training sorcerers",
  "events": [5, 12, 13, 24, 25, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 107],
  "image": "/locations/1.webp"
}
```

---

## 🔧 Tablas de Soporte Independientes

### 7. ArcsTable
- **Propósito**: Arcos narrativos
- **Relación Saliente**: `anime` → AnimeEpisodes (0 a N)
- **Estructura**:
```json
{
  "id": 1,
  "name": "Cursed Child Arc",
  "manga": "Ch0",
  "anime": [1]
}
```

### 8. AnimeEpisodesTable  
- **Propósito**: Episodios de anime
- **Relación Saliente**: `arc` → Arcs (1 obligatorio)
- **Estructura Real**:
```json
{
  "id": 1,
  "episode_number": "0",
  "arc": 1,
  "season": "Season 0",
  "title": "Jujutsu Kaisen 0: The Movie",
  "mangachapters_adapted": "Ch0",
  "air_date": "December 24, 2021",
  "opening_theme": null,
  "ending_theme": null,
  "image": "/animeEpisodes/1.webp"
}
```

### 9. MangaVolumesTable
- **Propósito**: Volúmenes de manga
- **Sin relaciones**: Tabla completamente independiente

---

## 📊 Tablas Estáticas de Soporte (Valores Reales)

Estas tablas proporcionan valores predefinidos para evitar duplicación:

- **Species** (`speciesId`): 
  - 1: Human, 2: Cursed Spirit, 3: Shikigami, 4: Cursed Womb, 5: Cursed Corpse, 6: Transfigured Human, 7: Incarnate Body, 8: Vengeful Spirit, 9: Immortal

- **Gender** (`gender`): 
  - 1: Male, 2: Female, 3: Unknown

- **Grades** (`gradeId`): 
  - 1: Grade 4, 2: Grade 3, 3: Semi-Grade 2, 4: Grade 2, 5: Semi-Grade 1, 6: Grade 1, 7: Semi-Special Grade, 8: Special Grade

- **Status** (`status`): 
  - 1: Alive, 2: Dead, 3: Unknown, 4: Incarnated

- **Occupations** (`occupationId`): 
  - 1: First-Year Student, 2: Second-Year Student, 3: Third-Year Student, 4: Jujutsu Sorcerer, 5: Cursed User, 6: Assistant, 7: Clan Leader, 8: Teacher, 9: Principal, 10: Doctor, 11: Driver, 12: Vessel, 13: Civilian, 14: High School Student, 15: Shikigami, 16: Ancient Sorcerer, 17: Sorcerer, 18: Non-Curse User

- **TechniqueTypes** (`type`): 
  - 1: Innate Technique, 2: Extension Technique, 3: Cursed Spirit, 4: Barrier Techniques, 5: Anti-Domain Technique, 6: Shikigami Control, 7: Inherited Techniques, 8: Shikigami Ability, 9: Taijutsu, 10: Restriction, 11: Reverse Technique, 12: New Shadow Style Technique, 13: Cursed Spirit Ability

- **TechniqueRanges** (`range`): 
  - 1: Short Range, 2: Medium Range, 3: Long Range, 4: Variable Range, 5: Self

---

## 🛣️ HOJA DE RUTA PARA LARAVEL API

### FASE 1: FUNDACIÓN DE BASE DE DATOS

#### 1.1 Migrations Order (Orden de Creación)
```php
// Primero: Tablas estáticas (sin dependencias)
2024_01_01_000001_create_species_table.php
2024_01_01_000002_create_genders_table.php  
2024_01_01_000003_create_grades_table.php
2024_01_01_000004_create_statuses_table.php
2024_01_01_000005_create_occupations_table.php
2024_01_01_000006_create_technique_types_table.php
2024_01_01_000007_create_technique_ranges_table.php

// Segundo: Tabla central
2024_01_01_000008_create_characters_table.php

// Tercero: Tablas relacionales
2024_01_01_000009_create_affiliations_table.php
2024_01_01_000010_create_locations_table.php
2024_01_01_000011_create_battles_table.php
2024_01_01_000012_create_cursed_techniques_table.php
2024_01_01_000013_create_cursed_tools_table.php
2024_01_01_000014_create_domain_expansions_table.php

// Cuarto: Tablas independientes
2024_01_01_000015_create_arcs_table.php
2024_01_01_000016_create_anime_episodes_table.php
2024_01_01_000017_create_manga_volumes_table.php

// Quinto: Tablas pivot (relaciones muchos-muchos)
2024_01_01_000018_create_character_occupation_table.php
2024_01_01_000019_create_character_affiliation_table.php
2024_01_01_000020_create_character_cursed_technique_table.php
2024_01_01_000021_create_character_cursed_tool_table.php
2024_01_01_000022_create_character_battle_table.php
2024_01_01_000023_create_battle_participant_table.php
2024_01_01_000024_create_battle_non_direct_participant_table.php
```

#### 1.2 Models y Relaciones Eloquent

**Character Model (Central) - Campos Reales:**
```php
<?php
class Character extends Model {
    protected $fillable = [
        'name', 'alias', 'species_id', 'birthday', 'height', 'age', 
        'gender', 'anime_debut', 'manga_debut', 'grade_id', 
        'domain_expansion_id', 'status', 'relatives', 'image'
    ];
    
    protected $casts = [
        'alias' => 'array',
        'relatives' => 'array',
        'gender' => 'integer',
        'status' => 'integer',
    ];
    
    // Relaciones Muchos-Muchos
    public function occupations() {
        return $this->belongsToMany(Occupation::class, 'character_occupation');
    }
    
    public function affiliations() {
        return $this->belongsToMany(Affiliation::class, 'character_affiliation');
    }
    
    public function cursedTechniques() {
        return $this->belongsToMany(CursedTechnique::class, 'character_cursed_technique');
    }
    
    public function cursedTools() {
        return $this->belongsToMany(CursedTool::class, 'character_cursed_tool');
    }
    
    public function battles() {
        return $this->belongsToMany(Battle::class, 'battle_participant');
    }
    
    public function nonDirectBattles() {
        return $this->belongsToMany(Battle::class, 'battle_non_direct_participant');
    }
    
    // Relaciones Uno-Muchos/Uno-Uno
    public function species() {
        return $this->belongsTo(Species::class);
    }
    
    public function grade() {
        return $this->belongsTo(Grade::class);
    }
    
    public function domainExpansion() {
        return $this->belongsTo(DomainExpansion::class);
    }
}
```

**Battle Model - Campos Reales:**
```php
class Battle extends Model {
    protected $fillable = [
        'event', 'result', 'arc', 'date', 'location', 'location_data', 'image'
    ];
    
    public function locationData() {
        return $this->belongsTo(Location::class, 'location_data');
    }
    
    public function participants() {
        return $this->belongsToMany(Character::class, 'battle_participant');
    }
    
    public function nonDirectParticipants() {
        return $this->belongsToMany(Character::class, 'battle_non_direct_participant');
    }
}
```

**CursedTechnique Model - Campos Reales:**
```php
class CursedTechnique extends Model {
    protected $fillable = [
        'technique_name', 'description', 'type', 'range', 'image'
    ];
    
    public function techniqueType() {
        return $this->belongsTo(TechniqueType::class, 'type');
    }
    
    public function techniqueRange() {
        return $this->belongsTo(TechniqueRange::class, 'range');
    }
    
    public function users() {
        return $this->belongsToMany(Character::class, 'character_cursed_technique');
    }
}
```

**DomainExpansion Model - Campos Reales:**
```php
class DomainExpansion extends Model {
    protected $fillable = [
        'name', 'user', 'range', 'Type', 'description', 'image'
    ];
    
    public function owner() {
        return $this->belongsTo(Character::class, 'user');
    }
}
```

**AnimeEpisode Model - Campos Reales:**
```php
class AnimeEpisode extends Model {
    protected $fillable = [
        'episode_number', 'arc', 'season', 'title', 
        'mangachapters_adapted', 'air_date', 'opening_theme', 
        'ending_theme', 'image'
    ];
    
    public function arcData() {
        return $this->belongsTo(Arc::class, 'arc');
    }
}
```

### FASE 2: SEEDERS Y POBLADO DE DATOS

#### 2.1 Estrategia de Seeding
```php
// DatabaseSeeder.php
public function run() {
    // 1. Tablas estáticas primero
    $this->call([
        SpeciesSeeder::class,
        GenderSeeder::class,
        GradeSeeder::class,
        StatusSeeder::class,
        OccupationSeeder::class,
        TechniqueTypeSeeder::class,
        TechniqueRangeSeeder::class,
    ]);
    
    // 2. Datos independientes
    $this->call([
        LocationSeeder::class,
        ArcSeeder::class,
        AnimeEpisodeSeeder::class,
        MangaVolumeSeeder::class,
    ]);
    
    // 3. Tabla central
    $this->call(CharacterSeeder::class);
    
    // 4. Tablas relacionales
    $this->call([
        AffiliationSeeder::class,
        CursedTechniqueSeeder::class,
        CursedToolSeeder::class,
        DomainExpansionSeeder::class,
        BattleSeeder::class,
    ]);
    
    // 5. Relaciones muchos-muchos
    $this->call(RelationshipSeeder::class);
}
```

### FASE 3: API RESOURCES Y CONTROLLERS

#### 3.1 Estructura de API Resources (Basada en Datos Reales)
```php
// CharacterResource.php
public function toArray($request) {
    return [
        'id' => $this->id,
        'name' => $this->name,
        'alias' => $this->alias, // Array de aliases
        'species' => new SpeciesResource($this->whenLoaded('species')),
        'birthday' => $this->birthday,
        'height' => $this->height,
        'age' => $this->age,
        'gender' => $this->gender,
        'occupations' => OccupationResource::collection($this->whenLoaded('occupations')),
        'affiliations' => AffiliationResource::collection($this->whenLoaded('affiliations')),
        'anime_debut' => $this->anime_debut,
        'manga_debut' => $this->manga_debut,
        'cursed_techniques' => CursedTechniqueResource::collection($this->whenLoaded('cursedTechniques')),
        'grade' => new GradeResource($this->whenLoaded('grade')),
        'domain_expansion' => new DomainExpansionResource($this->whenLoaded('domainExpansion')),
        'battles' => BattleResource::collection($this->whenLoaded('battles')),
        'cursed_tools' => CursedToolResource::collection($this->whenLoaded('cursedTools')),
        'status' => $this->status,
        'relatives' => $this->relatives, // Array de familiares
        'image' => $this->image,
    ];
}

// BattleResource.php
public function toArray($request) {
    return [
        'id' => $this->id,
        'event' => $this->event,
        'result' => $this->result,
        'arc' => $this->arc,
        'date' => $this->date,
        'location' => $this->location,
        'location_data' => new LocationResource($this->whenLoaded('locationData')),
        'participants' => CharacterResource::collection($this->whenLoaded('participants')),
        'non_direct_participants' => CharacterResource::collection($this->whenLoaded('nonDirectParticipants')),
        'image' => $this->image,
    ];
}

// CursedTechniqueResource.php  
public function toArray($request) {
    return [
        'id' => $this->id,
        'technique_name' => $this->technique_name,
        'description' => $this->description,
        'type' => new TechniqueTypeResource($this->whenLoaded('techniqueType')),
        'range' => new TechniqueRangeResource($this->whenLoaded('techniqueRange')),
        'users' => CharacterResource::collection($this->whenLoaded('users')),
        'image' => $this->image,
    ];
}

// AnimeEpisodeResource.php
public function toArray($request) {
    return [
        'id' => $this->id,
        'episode_number' => $this->episode_number,
        'arc' => new ArcResource($this->whenLoaded('arcData')),
        'season' => $this->season,
        'title' => $this->title,
        'manga_chapters_adapted' => $this->mangachapters_adapted,
        'air_date' => $this->air_date,
        'opening_theme' => $this->opening_theme,
        'ending_theme' => $this->ending_theme,
        'image' => $this->image,
    ];
}
```

#### 3.2 Controllers con Eager Loading Inteligente
```php
class CharacterController extends Controller {
    public function index(Request $request) {
        $query = Character::query();
        
        // Eager loading condicional
        $includes = $request->get('include', []);
        if(in_array('species', $includes)) $query->with('species');
        if(in_array('occupations', $includes)) $query->with('occupations');
        if(in_array('battles', $includes)) $query->with('battles');
        // etc...
        
        return CharacterResource::collection(
            $query->paginate($request->get('per_page', 15))
        );
    }
    
    public function show(Character $character, Request $request) {
        // Cargar todas las relaciones para vista detallada
        $character->load([
            'species', 'occupations', 'affiliations', 
            'cursedTechniques', 'battles', 'domainExpansion', 
            'cursedTools'
        ]);
        
        return new CharacterResource($character);
    }
}
```

### FASE 4: OPTIMIZACIÓN Y PERFORMANCE

#### 4.1 Indexes Estratégicos
```php
// En migrations agregar indexes
$table->index('species_id');
$table->index('grade_id');
$table->index(['status', 'species_id']); // Composite index
$table->fullText(['name', 'alias']); // Para búsqueda de texto
```

#### 4.2 Caché Inteligente
```php
// CacheService.php
class CacheService {
    public function getCharacterWithRelations($id) {
        return Cache::remember("character.{$id}.full", 3600, function() use ($id) {
            return Character::with([
                'species', 'occupations', 'affiliations',
                'cursedTechniques', 'battles', 'domainExpansion'
            ])->find($id);
        });
    }
    
    public function getStaticTables() {
        return Cache::remember('static.tables', 86400, function() {
            return [
                'species' => Species::all(),
                'grades' => Grade::all(),
                'occupations' => Occupation::all(),
                // etc...
            ];
        });
    }
}
```

### FASE 5: ENDPOINTS AVANZADOS

#### 5.1 Búsqueda y Filtrado
```php
// routes/api.php
Route::prefix('v1')->group(function() {
    // CRUD básico
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('battles', BattleController::class);
    Route::apiResource('cursed-techniques', CursedTechniqueController::class);
    
    // Endpoints especializados
    Route::get('characters/{character}/battles', [CharacterController::class, 'battles']);
    Route::get('characters/{character}/techniques', [CharacterController::class, 'techniques']);
    Route::get('battles/{battle}/participants', [BattleController::class, 'participants']);
    
    // Búsqueda avanzada
    Route::get('search/characters', [SearchController::class, 'characters']);
    Route::get('search/global', [SearchController::class, 'global']);
    
    // Estadísticas
    Route::get('stats/overview', [StatsController::class, 'overview']);
    Route::get('stats/battles', [StatsController::class, 'battles']);
    
    // Tablas estáticas (caché largo)
    Route::get('static/species', [StaticController::class, 'species']);
    Route::get('static/grades', [StaticController::class, 'grades']);
});
```

#### 5.2 Filtros Avanzados
```php
class CharacterFilter {
    public function apply(Builder $query, array $filters) {
        if(isset($filters['species'])) {
            $query->where('species_id', $filters['species']);
        }
        
        if(isset($filters['grade'])) {
            $query->where('grade_id', $filters['grade']);
        }
        
        if(isset($filters['has_domain'])) {
            $query->whereNotNull('domain_expansion_id');
        }
        
        if(isset($filters['affiliation'])) {
            $query->whereHas('affiliations', function($q) use ($filters) {
                $q->where('affiliation_id', $filters['affiliation']);
            });
        }
        
        if(isset($filters['search'])) {
            $query->whereFullText(['name', 'alias'], $filters['search']);
        }
        
        return $query;
    }
}
```

---

## 🔍 CONSIDERACIONES ESPECIALES BASADAS EN DATOS REALES

### 1. **Manejo de Arrays JSON**
Los siguientes campos se almacenan como JSON arrays en los datos originales:
- `alias` en Characters: `["Sukuna's Vessel", "Tiger of West Jr High", "Yuu-chan"]`
- `relatives` en Characters: `["Kaori Itadori (Mother)", "Jin Itadori (Father)"]`
- `participants` y `nonDirectParticipants` en Battles: `[4, 14, 111, 112]`
- `events` en Locations: `[5, 12, 13, 24, 25, 31, 32]`

**Estrategia Laravel**: Usar cast 'array' para campos de información simple (alias, relatives) y tablas pivot para relaciones (participants, events).

### 2. **Campos de Texto Largo**
- `description` en CursedTechniques, CursedTools, DomainExpansions: usar TEXT en lugar de VARCHAR
- `result` en Battles: puede ser muy largo, usar TEXT

### 3. **Campos de Fecha Flexibles**
- `birthday` en Characters: formato string libre ("March 20", "December 22")
- `air_date` en AnimeEpisodes: formato específico ("December 24, 2021")
- `date` en Battles: formato variable ("August 2006")

**Recomendación**: Mantener como STRING para flexibilidad, no usar DATE estricto.

### 4. **Claves Foráneas Opcionales**
Muchas relaciones son opcionales (nullable):
- `domainExpansionId` en Characters (no todos tienen dominio)
- `location_data` en Battles (algunos no tienen ubicación específica)
- `opening_theme`, `ending_theme` en AnimeEpisodes (pueden ser null)

### 5. **Convenciones de Nombres**
Los JSON usan diferentes convenciones:
- CamelCase: `cursedTechniquesIds`, `domainExpansionId`, `nonDirectParticipants`
- Snake_case: `location_data`, `technique_name`, `episode_number`
- Inconsistencias: `mangachapters_adapted` (sin underscore)

**Recomendación Laravel**: Normalizar todo a snake_case en la base de datos.

---

## 🎯 CONSIDERACIONES TÉCNICAS IMPORTANTES

### 1. **Manejo de Arrays en JSON Original**
Los arrays como `occupationId: [1, 4, 15]` se convierten en tablas pivot en Laravel para mantener normalización.

### 2. **Campos Estáticos vs Tablas (Decisión Basada en Datos Reales)**
- **Usar Tablas** para: Species (9 valores), Grades (8 valores), Occupations (18+ valores), TechniqueTypes (13+ valores), TechniqueRanges (5 valores)
- **Usar Enteros Simples** para: Gender (3 valores fijos), Status (4 valores fijos) - raramente cambian

**Justificación**: Todas las "tablas estáticas" tienen suficientes valores y potencial de crecimiento para justificar tablas reales en lugar de enums.

### 3. **Estrategia de Imagen**
Mantener estructura `/category/id.webp` como está, añadir configuración en `.env`:
```bash
ASSETS_URL=https://cdn.jujutsukaisen-api.com
IMAGES_PATH=/images
```

### 4. **Performance Critical**
- **Eager Loading** obligatorio para evitar N+1 queries
- **Pagination** en todas las listas
- **Cache** para tablas estáticas (24h)
- **Cache** para consultas complejas (1h)

### 5. **Validación y Integridad (Campos Reales)**
```php
// CharacterRequest.php
public function rules() {
    return [
        'name' => 'required|string|max:255',
        'alias' => 'array',
        'alias.*' => 'string|max:255',
        'species_id' => 'nullable|exists:species,id',
        'birthday' => 'nullable|string|max:50',
        'height' => 'nullable|string|max:50',
        'age' => 'nullable|string|max:10',
        'gender' => 'nullable|integer|between:1,3',
        'occupation_ids' => 'array',
        'occupation_ids.*' => 'exists:occupations,id',
        'affiliation_ids' => 'array', 
        'affiliation_ids.*' => 'exists:affiliations,id',
        'anime_debut' => 'nullable|string|max:50',
        'manga_debut' => 'nullable|string|max:50',
        'cursed_technique_ids' => 'array',
        'cursed_technique_ids.*' => 'exists:cursed_techniques,id',
        'grade_id' => 'nullable|exists:grades,id',
        'domain_expansion_id' => 'nullable|exists:domain_expansions,id',
        'battle_ids' => 'array',
        'battle_ids.*' => 'exists:battles,id',
        'cursed_tool_ids' => 'array',
        'cursed_tool_ids.*' => 'exists:cursed_tools,id',
        'status' => 'nullable|integer|between:1,4',
        'relatives' => 'array',
        'relatives.*' => 'string|max:255',
        'image' => 'nullable|string|max:255',
    ];
}

// BattleRequest.php
public function rules() {
    return [
        'event' => 'required|string|max:500',
        'result' => 'required|string|max:1000',
        'arc' => 'required|string|max:255',
        'date' => 'nullable|string|max:100',
        'location' => 'required|string|max:255',
        'location_data' => 'nullable|exists:locations,id',
        'participant_ids' => 'array',
        'participant_ids.*' => 'exists:characters,id',
        'non_direct_participant_ids' => 'array',
        'non_direct_participant_ids.*' => 'exists:characters,id',
        'image' => 'nullable|string|max:255',
    ];
}

// CursedTechniqueRequest.php
public function rules() {
    return [
        'technique_name' => 'required|string|max:255',
        'description' => 'required|string|max:2000',
        'type' => 'required|exists:technique_types,id',
        'range' => 'required|exists:technique_ranges,id',
        'user_ids' => 'array',
        'user_ids.*' => 'exists:characters,id',
        'image' => 'nullable|string|max:255',
    ];
}
```

---

## ✅ CHECKLIST DE IMPLEMENTACIÓN

### Fase 1: Base
- [ ] Crear migrations en orden correcto
- [ ] Definir models con relaciones
- [ ] Implementar seeders con datos JSON
- [ ] Configurar enums para campos estáticos

### Fase 2: API Base  
- [ ] Crear resources para serialización
- [ ] Implementar controllers CRUD básicos
- [ ] Configurar rutas API
- [ ] Añadir validación de requests

### Fase 3: Funcionalidad Avanzada
- [ ] Implementar sistema de búsqueda
- [ ] Añadir filtros avanzados
- [ ] Crear endpoints especializados
- [ ] Configurar sistema de cache

### Fase 4: Optimización
- [ ] Añadir indexes de base de datos
- [ ] Implementar eager loading inteligente
- [ ] Configurar cache para consultas frecuentes
- [ ] Optimizar queries N+1

### Fase 5: Documentación y Testing
- [ ] Generar documentación API (Swagger/OpenAPI)
- [ ] Escribir tests unitarios y de integración
- [ ] Configurar CI/CD
- [ ] Implementar logging y monitoring

---

Este README proporciona una hoja de ruta completa para transformar tu estructura JSON en una API Laravel robusta, manteniendo la integridad relacional y optimizando el rendimiento.

Entre otras informaciones del universo JJK
# Jujutsu Kaisen API

- **Base URL:** `https://api.jujutsukaisenapi.site/api/v1`
- **Format:** JSON
- **Authentication:** None

---

## Enumerated Values

Many fields use integer IDs that map to fixed values.

### Gender
| ID | Value |
|---|---|
| `1` | Male |
| `2` | Female |
| `3` | Genderless |

### Status
| ID | Value |
|---|---|
| `1` | Alive |
| `2` | Dead |
| `3` | Unknown |

### Grade
| ID | Value |
|---|---|
| `1` | Grade 4 |
| `2` | Grade 3 |
| `3` | Semi-Grade 2 |
| `4` | Grade 2 |
| `5` | Semi-Grade 1 |
| `6` | Grade 1 |
| `7` | Semi-Special Grade |
| `8` | Special Grade |

### Species
| ID | Value |
|---|---|
| `1` | Human |
| `2` | Cursed Spirit |
| `3` | Shikigami |
| `4` | Cursed Womb |
| `5` | Cursed Corpse |
| `6` | Transfigured Human |
| `7` | Incarnate Body |
| `8` | Vengeful Spirit |
| `9` | Immortal |

### Technique Type
| ID | Value |
|---|---|
| `1` | Innate Technique |
| `2` | Extension Technique |
| `3` | Cursed Spirit |
| `4` | Barrier Techniques |
| `5` | Anti-Domain Technique |
| `6` | Shikigami Control |
| `7` | Inherited Techniques |
| `8` | Shikigami Ability |
| `9` | Taijutsu |
| `10` | Restriction |
| `11` | Reverse Technique |
| `12` | New Shadow Style Technique |
| `13` | Cursed Spirit Ability |

### Technique Range
| ID | Value |
|---|---|
| `1` | Short Range |
| `2` | Medium Range |
| `3` | Long Range |
| `4` | Variable Range |
| `5` | Self |

---

## Pagination

Endpoints that return collections support pagination via query parameters.

| Parameter | Type | Default | Max | Description |
|---|---|---|---|---|
| `per_page` | integer | `20` | `100` | Items per page |
| `page` | integer | `1` | — | Page number |

**Paginated response envelope:**
```json
{
  "current_page": 1,
  "data": [...],
  "first_page_url": "...",
  "from": 1,
  "last_page": 13,
  "last_page_url": "...",
  "next_page_url": "...",
  "path": "...",
  "per_page": 20,
  "prev_page_url": null,
  "to": 20,
  "total": 242
}
```

---

## Endpoints

### Characters

#### `GET /api/v1/characters`
Returns a paginated list of all characters.

**Query parameters:** `per_page`, `page`

**Response `200`:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "name": "Yuji Itadori",
      "alias": ["Divergent Fist", "Tiger Estoc"],
      "speciesId": 1,
      "birthday": "March 20",
      "height": "173 cm",
      "age": "15",
      "gender": 1,
      "occupationId": [1],
      "affiliationId": [1],
      "animeDebut": "Episode 1",
      "mangaDebut": "Chapter 1",
      "cursedTechniquesIds": [1],
      "gradeId": 4,
      "domainExpansionId": null,
      "battlesId": [1, 2, 3],
      "cursedToolId": [],
      "status": 1,
      "relatives": [],
      "image": "/Media/Characters/1.webp"
    }
  ],
  "total": 242,
  ...
}
```

---

#### `GET /api/v1/characters/{id}`
Returns a single character by numeric ID.

**Path parameters:**
| Parameter | Type | Description |
|---|---|---|
| `id` | integer | Character ID |

**Response `200`:** Character object (same schema as above)
**Response `404`:** `{ "error": "Character not found" }`

---

#### `GET /api/v1/characters/search?q={name}`
Full-text search on character names (case-insensitive, partial match).

**Query parameters:**
| Parameter | Type | Description |
|---|---|---|
| `q` | string | Search term |

---

#### `GET /api/v1/characters/with-domain-expansion`
Returns all characters that have a domain expansion (`domainExpansionId` is not null).

---

#### `GET /api/v1/characters/filter/gender/{gender}`
Filter characters by gender ID.

| `{gender}` | Value |
|---|---|
| `1` | Male |
| `2` | Female |
| `3` | Genderless |

---

#### `GET /api/v1/characters/filter/status/{status}`
Filter characters by status ID.

| `{status}` | Value |
|---|---|
| `1` | Alive |
| `2` | Dead |
| `3` | Unknown |

---

#### `GET /api/v1/characters/filter/species/{speciesId}`
Filter characters by species ID. See [Species enum](#species).

---

#### `GET /api/v1/characters/filter/grade/{gradeId}`
Filter characters by jujutsu grade ID. See [Grade enum](#grade).

---

#### `GET /api/v1/characters/filter/affiliation/{affiliationId}`
Filter characters that belong to a given affiliation.

---

#### `GET /api/v1/characters/filter/occupation/{occupationId}`
Filter characters by occupation.

---

#### `GET /api/v1/characters/filter/anime-debut/{episode}`
Filter characters by their anime debut episode string (e.g. `Episode 1`).

---

#### `GET /api/v1/characters/filter/manga-debut/{chapter}`
Filter characters by their manga debut chapter string (e.g. `Chapter 1`).

---

#### `GET /api/v1/characters/{id}/species`
Returns the character with their species object expanded.

---

#### `GET /api/v1/characters/{id}/affiliations`
Returns the character with their full affiliation objects expanded.

---

#### `GET /api/v1/characters/{id}/techniques`
Returns the character with their full cursed technique objects expanded.

---

#### `GET /api/v1/characters/{id}/battles`
Returns the character with all battles they participated in expanded.

---

#### `GET /api/v1/characters/{id}/full-profile`
Returns the character with all relational data fully expanded (species, affiliations, techniques, battles, domain expansion, tools).

---

#### `GET /api/v1/characters/{id}/stats`
Returns a compact stats object for the character.

---

### Affiliations

#### `GET /api/v1/affiliations`
Returns all affiliations.

**Response `200`:**
```json
[
  {
    "id": 1,
    "affiliation_name": "Tokyo Jujutsu High",
    "description": "...",
    "image": "/Media/Affiliations/Tokyo_Jujutsu_High.webp"
  }
]
```

#### `GET /api/v1/affiliations/{id}`
Returns a single affiliation by ID.

**Response `404`:** `{ "error": "Affiliation not found" }`

---

### Cursed Techniques

#### `GET /api/v1/cursed-techniques`
Returns a paginated list of cursed techniques. Supports filtering via query parameters.

**Query parameters:**
| Parameter | Type | Description |
|---|---|---|
| `per_page` | integer | Items per page (max 100) |
| `search` | string | Search in `technique_name` and `description` |
| `type` | integer | Filter by technique type ID |
| `range` | integer | Filter by range ID |

**Response `200` item schema:**
```json
{
  "id": 1,
  "technique_name": "Divergent Fist",
  "description": "...",
  "type": 1,
  "range": 1,
  "users": [1],
  "image": "/Media/CursedTechniques/1.webp"
}
```

#### `GET /api/v1/cursed-techniques/{id}`
Returns a single technique by ID.

**Response `404`:** `{ "error": "Cursed technique not found" }`

#### `GET /api/v1/cursed-techniques/filter/type/{type}`
Filter techniques by type ID. See [Technique Type enum](#technique-type).

---

### Cursed Tools

#### `GET /api/v1/cursed-tools`
Returns all cursed tools.

**Response `200` item schema:**
```json
{
  "id": 1,
  "name": "Playful Cloud",
  "type": "Grade 1",
  "owners": [1],
  "description": "...",
  "image": "/Media/CursedTools/1.webp"
}
```

#### `GET /api/v1/cursed-tools/{id}`
Returns a single tool by ID.

**Response `404`:** `{ "error": "Cursed tool not found" }`

#### `GET /api/v1/cursed-tools/filter/type/{type}`
Filter tools by type string.

---

### Domain Expansions

#### `GET /api/v1/domain-expansions`
Returns all domain expansions.

**Response `200` item schema:**
```json
{
  "id": 1,
  "name": "Unlimited Void",
  "user": 2,
  "range": "...",
  "Type": "...",
  "description": "...",
  "image": "/Media/DomainExpansions/1.webp"
}
```

#### `GET /api/v1/domain-expansions/{id}`
Returns a single domain expansion by ID.

**Response `404`:** `{ "error": "Domain expansion not found" }`

#### `GET /api/v1/domain-expansions/user/{userId}`
Returns all domain expansions belonging to the character with the given `userId`.

---

### Battles

#### `GET /api/v1/battles`
Returns a paginated list of battles. Supports filtering.

**Query parameters:**
| Parameter | Type | Description |
|---|---|---|
| `per_page` | integer | Items per page (max 100) |
| `search` | string | Search in `event` and `result` fields |
| `arc` | string | Filter by arc name |

**Response `200` item schema:**
```json
{
  "id": 1,
  "event": "Yuji vs Junpei",
  "result": "...",
  "arc": "Cursed Child Arc",
  "date": null,
  "location": "...",
  "location_data": 5,
  "participants": [1, 12],
  "nonDirectParticipants": [],
  "image": "/Media/Battles/1.webp"
}
```

#### `GET /api/v1/battles/{id}`
Returns a single battle by ID.

**Response `404`:** `{ "error": "Battle not found" }`

#### `GET /api/v1/battles/filter/arc/{arc}`
Filter battles by arc name string.

---

### Locations

#### `GET /api/v1/locations`
Returns all locations.

**Response `200` item schema:**
```json
{
  "id": 1,
  "location_name": "Tokyo Prefectural Jujutsu High School",
  "located_in": "Tokyo, Japan",
  "description": "...",
  "events": [1, 5],
  "image": "/Media/Locations/1.webp"
}
```

#### `GET /api/v1/locations/{id}`
Returns a single location by ID.

**Response `404`:** `{ "error": "Location not found" }`

#### `GET /api/v1/locations/search?q={term}`
Search locations by `location_name` or `located_in` (partial, case-insensitive).

---

### Arcs

#### `GET /api/v1/arcs`
Returns all story arcs.

**Response `200` item schema:**
```json
{
  "id": 1,
  "name": "Cursed Child Arc",
  "manga": "Chapters 1–8",
  "anime": ["Season 1", "Episodes 1–5"],
  "image": "/Media/ArcsCovers/1.webp"
}
```

#### `GET /api/v1/arcs/{id}`
Returns a single arc by ID.

**Response `404`:** `{ "error": "Arc not found" }`

---

### Anime Episodes

#### `GET /api/v1/anime-episodes`
Returns a paginated list of anime episodes.

**Query parameters:** `per_page`, `page`

**Response `200` item schema:**
```json
{
  "id": 1,
  "episode_number": "1",
  "arc": 1,
  "season": "Season 1",
  "title": "Ryomen Sukuna",
  "mangachapters_adapted": "Chapters 1-3",
  "air_date": "2020-10-03",
  "opening_theme": "Kaikai Kitan",
  "ending_theme": "lost in paradise",
  "image": "/Media/AnimeEpisodes/1.webp"
}
```

#### `GET /api/v1/anime-episodes/{id}`
Returns a single episode by ID.

**Response `404`:** `{ "error": "Episode not found" }`

#### `GET /api/v1/anime-episodes/filter/season/{season}`
Filter episodes by season string (e.g. `Season 1`).

#### `GET /api/v1/anime-episodes/filter/arc/{arcId}`
Filter episodes that belong to the given arc ID.

---

### Manga Volumes

#### `GET /api/v1/manga-volumes`
Returns all manga volumes.

**Response `200` item schema:**
```json
{
  "id": 1,
  "volume_number": "1",
  "volume_name": "Ryomen Sukuna",
  "release_date": "2018-12-04",
  "pages": 192,
  "chapters": "Chapters 1-8",
  "cover_character": "Yuji Itadori",
  "image": "/Media/MangaVolumes/1.webp"
}
```

#### `GET /api/v1/manga-volumes/{id}`
Returns a single volume by ID.

**Response `404`:** `{ "error": "Manga volume not found" }`

---

### Species

#### `GET /api/v1/species`
Returns all species entries.

#### `GET /api/v1/species/{id}`
Returns a single species by ID.

---

### Occupations

#### `GET /api/v1/occupations`
Returns all occupations.

#### `GET /api/v1/occupations/{id}`
Returns a single occupation by ID.

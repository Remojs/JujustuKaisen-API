# Estructura de Datos — JJK API

Se documenta la estructura **raw** (como est\u00e1 guardada en BD/JSON) y la estructura **API response** (como la devuelve la API con IDs resueltos).

---

## AFFILIATION

**Raw (BD):**
```json
{
  "id": 1,
  "affiliation_name": "Tokyo Jujutsu High",
  "type": "Jujutsu School",
  "controlled_by": 9,
  "location": "Tokyo Prefecture",
  "location_data": 1,
  "description": "...",
  "image": "/Media/Affiliations/Tokyo_Jujutsu_High.webp"
}
```
**API response** \u2014 `controlled_by` y `location_data` resueltos:
```json
{
  "id": 1,
  "affiliation_name": "Tokyo Jujutsu High",
  "type": "Jujutsu School",
  "controlled_by": { "id": 9, "name": "Masamichi Yaga", "image": "..." },
  "location": "Tokyo Prefecture",
  "location_data": { "id": 1, "location_name": "...", "located_in": "...", "description": "...", "image": "..." },
  "description": "...",
  "image": "/Media/Affiliations/Tokyo_Jujutsu_High.webp"
}
```

---

## ANIMEEPISODE

**Raw (BD) y API response** \u2014 sin cambios (arc es string del nombre):
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
  "image": "/Media/AnimeEpisodes/1.webp"
}
```

---

## ARC

**Raw (BD) y API response** \u2014 sin cambios:
```json
{
  "id": 1,
  "name": "Cursed Child Arc",
  "manga": "Ch0",
  "anime": [1],
  "image": "/Media/ArcsCovers/1.webp"
}
```

---

## BATTLE

**Raw (BD):**
```json
{
  "id": 1,
  "event": "Satoru Gojo & Suguru Geto vs. Bayer & Kokun",
  "result": "Gojo and Geto are victorious.",
  "arc": "Gojo Past Arc",
  "date": "August 2006",
  "location": "Outside Riko Amanai's house",
  "location_data": 33,
  "participants": [4, 14, 111, 112],
  "nonDirectParticipants": [71, 72, 141],
  "image": "/Media/Battles/1.webp"
}
```
**API response** \u2014 `location_data`, `participants` y `nonDirectParticipants` resueltos:
```json
{
  "id": 1,
  "event": "Satoru Gojo & Suguru Geto vs. Bayer & Kokun",
  "result": "Gojo and Geto are victorious.",
  "arc": "Gojo Past Arc",
  "date": "August 2006",
  "location": "Outside Riko Amanai's house",
  "location_data": { "id": 33, "location_name": "...", "located_in": "...", "description": "...", "image": "..." },
  "participants": [
    { "id": 4, "name": "Satoru Gojo", "image": "/Media/Characters/4.webp" },
    { "id": 14, "name": "Suguru Geto", "image": "/Media/Characters/14.webp" }
  ],
  "nonDirectParticipants": [
    { "id": 71, "name": "Riko Amanai", "image": "/Media/Characters/71.webp" }
  ],
  "image": "/Media/Battles/1.webp"
}
```

---

## CHARACTER

**Raw (BD):**
```json
{
  "id": 1,
  "name": "Yuji Itadori",
  "alias": ["Sukuna's Vessel", "Tiger of West Jr High"],
  "speciesId": 1,
  "birthday": "March 20",
  "height": "173 cm",
  "age": "15",
  "gender": 1,
  "occupationId": [1, 4, 15],
  "affiliationId": [1],
  "animeDebut": "Ep1",
  "mangaDebut": "Ch1",
  "cursedTechniquesIds": [51, 52, 56],
  "gradeId": 4,
  "domainExpansionId": 13,
  "battlesId": [14, 15, 16],
  "cursedToolId": [7],
  "status": 1,
  "relatives": ["Kaori Itadori (Mother)", "Jin Itadori (Father)"],
  "image": "/Media/Characters/1.webp"
}
```
**API response** \u2014 todos los IDs resueltos:
```json
{
  "id": 1,
  "name": "Yuji Itadori",
  "alias": ["Sukuna's Vessel", "Tiger of West Jr High"],
  "species": { "id": 1, "species_name": "Human", "description": "..." },
  "birthday": "March 20",
  "height": "173 cm",
  "age": "15",
  "gender": { "id": 1, "name": "Male" },
  "occupations": [
    { "id": 1, "occupation_name": "First-Year Student" },
    { "id": 4, "occupation_name": "Jujutsu Sorcerer" }
  ],
  "affiliations": [
    { "id": 1, "affiliation_name": "Tokyo Jujutsu High", "type": "Jujutsu School", "image": "..." }
  ],
  "animeDebut": "Ep1",
  "mangaDebut": "Ch1",
  "cursedTechniques": [
    {
      "id": 51,
      "technique_name": "Divergent Fist",
      "description": "...",
      "type": { "id": 1, "name": "Innate Technique" },
      "range": { "id": 1, "name": "Short Range" },
      "image": "..."
    }
  ],
  "grade": { "id": 4, "name": "Grade 2" },
  "domainExpansion": { "id": 13, "name": "Horizon of the Captivating Skandha", "description": "...", "image": "..." },
  "battles": [
    { "id": 14, "event": "...", "result": "...", "arc": "...", "date": "...", "image": "..." }
  ],
  "cursedTools": [
    { "id": 7, "name": "Slaughter Demon", "type": "Cursed Tool", "description": "...", "image": "..." }
  ],
  "status": { "id": 1, "name": "Alive" },
  "relatives": ["Kaori Itadori (Mother)", "Jin Itadori (Father)"],
  "image": "/Media/Characters/1.webp"
}
```

---

## CURSED TECHNIQUE

**Raw (BD):**
```json
{
  "id": 1,
  "technique_name": "Boogie Woogie",
  "description": "Allows him to switch the positions of anything with cursed energy within his range with a clap of his hands.",
  "type": 1,
  "range": 2,
  "users": [30],
  "image": "/Media/CursedTechniques/1.webp"
}
```
**API response** \u2014 `type`, `range` y `users` resueltos:
```json
{
  "id": 1,
  "technique_name": "Boogie Woogie",
  "description": "...",
  "type": { "id": 1, "name": "Innate Technique" },
  "range": { "id": 2, "name": "Medium Range" },
  "users": [
    { "id": 30, "name": "Aoi Todo", "image": "/Media/Characters/30.webp" }
  ],
  "image": "/Media/CursedTechniques/1.webp"
}
```

---

## CURSED TOOL

**Raw (BD) y API response** \u2014 sin cambios:
```json
{
  "id": 1,
  "name": "Inverted Spear of Heaven",
  "type": "Cursed Tool",
  "owners": [28],
  "description": "Nullifies any cursed technique upon impalement.",
  "image": "/Media/CursedTools/1.webp"
}
```

---

## DOMAIN EXPANSION

**Raw (BD):**
```json
{
  "id": 1,
  "name": "Unlimited Void",
  "user": 4,
  "range": "Enclosed barrier (surrounding area)",
  "Type": "Domain Expansion",
  "description": "Traps targets in an infinite void space...",
  "image": "/Media/DomainExpansions/1.webp"
}
```
**API response** \u2014 `user` resuelto:
```json
{
  "id": 1,
  "name": "Unlimited Void",
  "user": { "id": 4, "name": "Satoru Gojo", "image": "/Media/Characters/4.webp" },
  "range": "Enclosed barrier (surrounding area)",
  "Type": "Domain Expansion",
  "description": "Traps targets in an infinite void space...",
  "image": "/Media/DomainExpansions/1.webp"
}
```

---

## LOCATION

**Raw (BD) y API response** \u2014 sin cambios:
```json
{
  "id": 1,
  "location_name": "Tokyo Jujutsu High",
  "located_in": "Tokyo",
  "description": "One of Japan's two main jujutsu schools...",
  "events": [5, 12, 13, 24, 25],
  "image": "/Media/Locations/1.webp"
}
```

---

## MANGA VOLUME

**Raw (BD) y API response** \u2014 sin cambios:
```json
{
  "id": 1,
  "volume_number": "1",
  "volume_name": "Ryomen Sukuna",
  "release_date": "March 4, 2019",
  "pages": 192,
  "chapters": "Ch1-Ch8",
  "cover_character": "Yuji Itadori",
  "image": "/Media/MangaVolumes/1.webp"
}
```
        "id": <ID>,
        "affiliation_name": "",
        "type": "",
        "controlled_by": <ID del character> o null,
        "location": "",
        "location_data": "",
        "description": "",
        "image": ""

---ANIMEEPISODE:
        "id": <ID>,
        "episode_number": "",
        "arc":  <ID del Arc>,
        "season" : "",
        "title": "",
        "mangachapters_adapted": "",
        "air_date": "",
        "opening_theme": "",
        "ending_theme": "",
        "image": ""

---ARCS:
        "id": <ID>,
        "name": "",
        "manga": "",
        "anime": [<ID del AnimeEpisode>, <ID del AnimeEpisode>, <ID del AnimeEpisode>],
        "image": ""

---BATTLE:
        "id": <ID>,
        "event": "",
        "result": "",
        "arc": "",
        "date": "",
        "location": "",
        "location_data": <ID del Location>,
        "participants": [<ID del Character>, <ID del Character>, <ID del Character>],
        "nonDirectParticipants": [<ID del Character>, <ID del Character>, <ID del Character>] o null,
        "image": ""

---CHARACTERS:
        "id": <ID>,
        "name": ",
        "alias": ["", "", "", ""],
        "speciesId": <ID del constant de Specie>,
        "birthday": "",
        "height": "",
        "age": "",
        "gender": <ID deL enum de Gender>,
        "occupationId": [<ID de Occupation>, <ID de Occupation>, <ID de Occupation>] o null,
        "affiliationId": [<ID de Affiliation>, <ID de Affiliation>, <ID de Affiliation>] o null,
        "animeDebut": "",
        "mangaDebut": "",
        "cursedTechniquesIds": [<ID de CursedTechniques>, <ID de CursedTechniques>, <ID de CursedTechniques>] o null,
        "gradeId": <ID del constant de Grade> o null,
        "domainExpansionId": <ID de DomainExpansion> o null,
        "battlesId": [<ID de Battles>, <ID de Battles>, <ID de Battles>] o null,
        "cursedToolId": [<ID de CursedTool>, <ID de CursedTool>, <ID de CursedTool>] o null,
        "status": <ID deL enum de Status>,
        "relatives": ["","",""],
        "image": ""

---CURSEDTECHNIQUES:
        "id": <ID>,
        "image": "",
        "technique_name": "",
        "description": "",
        "type": <ID del constant de TechniqueType>,
        "range": <ID del constant de TechniqueRange>,
        "users": <ID de Characters>

---CURSEDTOOLS:
        "id": <ID>,
        "image": "",
        "name": "",
        "type": "",
        "owners": <ID del Character>,
        "description": ""

---DOMAINEXPANSION:
        "id": <ID>,
        "image": "",
        "name": "",
        "user": <ID del Character>,
        "range": "",
        "Type": "",
        "description": ""

---LOCATION:
        "id": <ID>,
        "location_name": "",
        "located_in": "",
        "description": """,
        "events": <ID del Battle>,
        "image": ""

---MANGAVOLUMES:
        "id": <ID>,
        "volume_number": "",
        "volume_name": "",
        "release_date": "",
        "pages": number,
        "chapters": "",
        "cover_character": ""
---

---AFFILIATION:
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
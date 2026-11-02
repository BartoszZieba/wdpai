# Lab 2 — jak przedstawić prowadzącemu

## Gdzie co jest

| Co | Gdzie |
|---|---|
| **PDF prototypu** | `docs/prototype/pdf/MaturaKorki_prototyp_Lab2.pdf` — wysyłasz formularzem z Lab 3 |
| **Kod** | https://github.com/BartoszZieba/wdpai — branch `main` po merge PR |
| **Działająca aplikacja** | http://localhost:8080 po `docker compose up` |
| **Prototyp w Stitchu** | projekt `MaturaKorki Tutoring Marketplace` (opcjonalnie pokazać) |
| **Figma** | S1 landing — potrzebny dopiero w Lab 3 |

## Przed demo — obowiązkowo

1. **Zmerguj PR** `feature/lab2-views` przez **Create a merge commit**.
2. `git switch main && git pull --ff-only`.
3. Uruchom Dockera:
   ```bash
   docker compose up -d --build
   docker compose exec php composer dump-autoload
   docker compose ps
   ```
4. Otwórz http://localhost:8080 i sprawdź:
   - `/` — landing,
   - `/tutors` — wyniki,
   - `/tutors/1` — profil,
   - `/booking?tutor=1` — rezerwacja,
   - `/dashboard` — panel,
   - `/tutors/999` — 404.
5. Otwórz PDF na 10 stron.

## Scenariusz 10–12 minut

### 1. GitHub (1–2 min)
- repo publiczne, branch `main`,
- README: opis projektu, routing, quick start,
- historia: 4 commity + PR z merge commitem (bez squash),
- struktura: `public/`, `src/controllers`, `src/Support`, `public/views/partials`.

### 2. PDF / prototyp (2 min)
- 5 przepływów × mobile + web = 10 ekranów:
  - landing → wyniki → profil → rezerwacja → panel.
- Podkreśl: filtry, profil z opiniami, rezerwacja, panel z lekcjami.

### 3. Aplikacja (3–4 min)
Kolejno:

| URL | Co pokazać |
|---|---|
| `/` | landing, wyszukiwarka, polecani |
| `/tutors` | lista 6 profili |
| `/tutors?level=Rozszerzenie&topic=Funkcje` | filtr: 2 wyniki |
| `/tutors/1` | profil Michała: ocena 4.9, 23 opinie, terminy |
| `/booking?tutor=1` | wybór terminu, notatka, podsumowanie |
| `/dashboard` | Najbliższe: 2 lekcje |
| `/dashboard?tab=history` | Zakończona + Anulowana |
| `/dashboard?tab=reviews` | formularz opinii |
| `/tutors/999` | 404 |
| `/nie-ma-takiej` | 404 |

### 4. Kod (3 min)
- `public/index.php` — trasy,
- `src/controllers/TutorController.php` — `index` + `show(int $id)`,
- `src/Support/TutorCatalog.php` — dane seed,
- `public/views/tutor.html.php` — **Z2.5**: `main`, `article`, `section`, `aside`, `dl`, `ul`, `time`,
- `public/views/partials/tutor-card.html.php` — reuse karty,
- `composer.json` — PSR-4 + autoloader (Z4*).

### 5. Git (1 min)
- małe commity, PR, merge commit,
- brak squashowania.

## O co może zapytać

| Pytanie | Odpowiedź |
|---|---|
| Dlaczego brak CSS? | Lab 3; teraz surowy semantyczny HTML. |
| Skąd dane? | `TutorCatalog` — seed; baza/PDO w kolejnych labach. |
| Czy formularze działają? | Są semantyczne; backend rezerwacji/auth w kolejnych labach. |
| Gdzie route z parametrem? | `/tutors/{id}` → `TutorController::show`. |
| Gdzie 404? | `/tutors/999`, `/tutors/abc`, nieznany adres. |
| Gdzie Z2.5? | Profil korepetytora — `public/views/tutor.html.php`. |
| Gdzie Z3? | 5 widoków + 404 + partials. |
| Gdzie Composer? | `composer.json`, PSR-4, tylko jeden `require_once` w `index.php`. |

## Fallback, jeśli Docker nie wstanie

```bash
cd wdpai
php -S 127.0.0.1:8080 -t public public/index.php
```

Wymaga `vendor/autoload.php` — jeśli go nie ma:
```bash
composer dump-autoload
```

## Po demo

- wyślij PDF formularzem **do 03.11**,
- zostaw repo na `main` po merge,
- ewentualnie dodaj `docs/` (PDF + specyfikacje) osobnym PR.

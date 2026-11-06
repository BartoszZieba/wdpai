# MaturaKorki — korepetycje z matematyki do matury

Projekt zaliczeniowy z przedmiotu **Projektowanie Aplikacji Internetowych (WDPAI)**.

Aplikacja internetowa dla maturzystów, którzy szukają korepetytora z matematyki. Pozwala filtrować profile po poziomie i dziale, sprawdzić opinie, zarezerwować termin i zarządzać lekcjami w panelu ucznia.

> Etap Lab 3: statyczny prototyp (PDF), semantyczne widoki HTML z danymi z kontrolerów, responsywny arkusz CSS (`public/css/style.css`) oraz przełącznik motywu light/dark (`public/js/themes.js`). Baza danych i logowanie pojawią się w kolejnych laboratoriach.

## Funkcje

| Obszar | Co robi |
|---|---|
| Strona główna | Landing z wyszukiwarką i polecanymi korepetytorami (`/`) |
| Wyniki | Lista profili + filtry poziomu i działu (`/tutors`) |
| Profil | Profil korepetytora, opinie i terminy (`/tutors/{id}`) |
| Rezerwacja | Wybór terminu, notatka i podsumowanie (`/booking`) |
| Panel ucznia | Najbliższe lekcje, historia i opinie (`/dashboard`) |
| Motyw | Przełącznik light/dark w nagłówku, zapamiętywany w `localStorage` |
| Obsługa 404 | Widok błędu dla nieznanych adresów |

## Tech stack

| Warstwa | Technologie |
|---|---|
| Backend | PHP 8.3 (PHP-FPM), autorski routing MVC |
| Serwer HTTP | nginx (FastCGI) |
| Baza danych | PostgreSQL 16 (planowana w kolejnych labach) |
| Konteneryzacja | Docker Compose |
| Autoloading | Composer (PSR-4) |
| Stylowanie | CSS: custom properties, Flexbox, Grid, mobile-first; motyw light/dark |
| Narzędzia | Mailpit, pgAdmin, Ollama (profil `ai`) |

## Wymagania i szybki start

- Git
- Docker Desktop

```bash
git clone https://github.com/BartoszZieba/wdpai.git
cd wdpai
cp .env.example .env
docker compose up --build -d
docker compose exec php composer dump-autoload
```

Aplikacja: http://localhost:8080

> `vendor/` nie jest zapisywany w repozytorium — autoloader generuje `composer dump-autoload` uruchomiony w kontenerze `php`.
>
> Ollama ma profil `ai`, więc domyślne `docker compose up` nie pobiera jej ani nie uruchamia.

## Routing

| Metoda | Ścieżka | Kontroler |
|---|---|---|
| GET | `/` | `DefaultController::index` |
| GET | `/tutors` | `TutorController::index` |
| GET | `/tutors/{id}` | `TutorController::show` |
| GET | `/booking` | `BookingController::index` |
| GET | `/dashboard` | `DashboardController::index` |
| — | nieznany adres | `DefaultController::notFound` + HTTP 404 |

## Struktura projektu

```
.
├── composer.json          # autoloading PSR-4
├── docker-compose.yaml
├── docker/                # obrazy nginx, PHP, PostgreSQL
├── public/                # jedyny publiczny katalog (front controller)
│   ├── css/style.css      # tokeny, komponenty, widoki, RWD, motyw ciemny
│   ├── js/themes.js       # przełącznik light/dark + localStorage
│   ├── index.php
│   └── views/             # szablony .html.php + partials/
└── src/
    ├── Routing.php        # router (regex, parametry ścieżki)
    ├── controllers/       # AppController + kontrolery widoków
    └── Support/           # TutorCatalog — dane demonstracyjne
```

Przepływ żądania: `public/index.php` → `App\Routing` → kontroler → `AppController::render()` → widok.

Dane korepetytorów są na razie w `App\Support\TutorCatalog` (seed). W kolejnych labach zastąpi je repozytorium/PDO i PostgreSQL.

## Konfiguracja

Wszystkie sekrety i parametry środowiska trzymamy w `.env` (ignorowanym przez Git). Wzór: `.env.example`.

| Zmienna | Opis |
|---|---|
| `APP_PORT` | port aplikacji (domyślnie 8080) |
| `POSTGRES_*` | dane bazy PostgreSQL |
| `PGADMIN_*` | dane logowania pgAdmin |
| `MAILPIT_PORT` | port panelu Mailpit |

## Adresy usług

| Usługa | Adres |
|---|---|
| Aplikacja | http://localhost:8080 |
| Mailpit | http://localhost:8025 |
| pgAdmin | http://localhost:5050 |
| PostgreSQL | localhost:5433 |
| Ollama | http://localhost:11434 |

## Zasady developmentu

- Każda funkcja na osobnym branchu (`feature/...`, `fix/...`, `chore/...`).
- Małe, logiczne commity z prefiksem (`feat:`, `fix:`, `docs:`, `refactor:`, `chore:`).
- Zmiany trafiają do `main` przez Pull Request i **Create a merge commit** (bez squashowania).
- Sekrety wyłącznie w `.env`; do repozytorium trafia tylko `.env.example`.

## API i testy

Na obecnym etapie brak endpointów JSON i testów automatycznych — planowane w kolejnych laboratoriach. Widoki są renderowane serwerowo w PHP, stylowanie znajduje się w `public/css/style.css`, a motyw obsługuje `public/js/themes.js`.

## Motyw light/dark

Domyślnie strona korzysta z ustawienia systemowego (`prefers-color-scheme`). Kliknięcie przycisku w nagłówku zapisuje wybór w `localStorage` pod kluczem `maturakorki-theme`; kolejne wejścia go respektują. Motyw jest ustawiany jeszcze w `<head>`, przed renderowaniem body, żeby uniknąć mignięcia jasnej strony.

## Autorzy

- Bartosz Zięba — [@BartoszZieba](https://github.com/BartoszZieba)

# MaturaKorki — korepetycje z matematyki do matury

Projekt zaliczeniowy z przedmiotu **Projektowanie Aplikacji Internetowych (WDPAI)**.

Aplikacja internetowa dla maturzystów, którzy szukają korepetytora z matematyki. Pozwala filtrować profile po poziomie i dziale, sprawdzić opinie, zarezerwować termin i zarządzać lekcjami w panelu ucznia.

> Etap Lab 6: statyczny prototyp (PDF), semantyczne widoki HTML z danymi z kontrolerów, wspólny layout, responsywny CSS (`public/css/tokens.css` + `public/css/style.css`), mobilna nawigacja, druk, przełącznik motywu light/dark (`public/js/themes.js`) oraz formularz rezerwacji POST z walidacją, CSRF i potwierdzeniem. Baza danych i logowanie pojawią się w kolejnych laboratoriach.

## Funkcje

| Obszar | Co robi |
|---|---|
| Strona główna | Landing z wyszukiwarką i polecanymi korepetytorami (`/`) |
| Wyniki | Lista profili + filtry poziomu i działu (`/tutors`) |
| Profil | Profil korepetytora, opinie i terminy (`/tutors/{id}`) |
| Rezerwacja | Formularz POST: termin, dane, notatka, zgoda; walidacja i CSRF (`/booking`) |
| Potwierdzenie | Numer zgłoszenia i status „Oczekuje na akceptację” (`/booking/success`) |
| Panel ucznia | Najbliższe lekcje, historia i opinie (`/dashboard`) |
| Motyw | Przełącznik light/dark w nagłówku, zapamiętywany w `localStorage` |
| Nawigacja mobilna | Hamburger, panel pełnoekranowy, obsługa `Escape` i fokusu |
| Druk | Osobny widok `@media print` bez nawigacji i formularzy |
| Obsługa błędów | 404 dla nieznanych adresów, 500 dla wyjątków aplikacji |

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
```

Aplikacja: http://localhost:8080

> `vendor/` nie jest zapisywany w repozytorium. Autoloader generuje się automatycznie przy starcie kontenera `php`; ręcznie uruchom `docker compose exec php composer dump-autoload` tylko po zmianie `composer.json`.
>
> Ollama ma profil `ai`, więc domyślne `docker compose up` nie pobiera jej ani nie uruchamia.

## Routing

| Metoda | Ścieżka | Kontroler |
|---|---|---|
| GET | `/` | `DefaultController::index` |
| GET | `/tutors` | `TutorController::index` |
| GET | `/tutors/{id}` | `TutorController::show` |
| GET | `/booking` | `BookingController::index` |
| POST | `/booking` | `BookingController::store` |
| GET | `/booking/success` | `BookingController::success` |
| GET | `/dashboard` | `DashboardController::index` |
| — | nieznany adres | `DefaultController::notFound` + HTTP 404 |

## Rezerwacja (Lab 6)

Formularz `POST /booking` jest walidowany po stronie serwera:

- imię i nazwisko: 3–80 znaków,
- e-mail: poprawny adres, maks. 120 znaków,
- termin: musi pochodzić z listy slotów korepetytora,
- notatka: maks. 300 znaków,
- zgoda: wymagana,
- CSRF: token z sesji sprawdzany przez `hash_equals`.

Po sukcesie aplikacja robi przekierowanie `303` na `/booking/success` (wzorzec Post/Redirect/Get). Błędy i wpisane wartości są przenoszone przez sesję (flash), a nowa rezerwacja pojawia się w `/dashboard`.

> Na tym etapie rezerwacje są zapisywane w sesji PHP, nie w PostgreSQL. Po wyczyszczeniu ciasteczek/restarcie sesji znikają. Model `App\Models\Booking` i `App\Support\BookingStore` są przygotowane do podmiany na repozytorium w Lab 7.

## Struktura projektu

```
.
├── composer.json          # autoloading PSR-4
├── docker-compose.yaml
├── docker/                # obrazy nginx, PHP, PostgreSQL
├── public/                # jedyny publiczny katalog (front controller)
│   ├── css/tokens.css     # zmienne: kolory, typografia, odstępy, promienie
│   ├── css/style.css      # komponenty, widoki, RWD, druk, motyw ciemny
│   ├── js/themes.js       # przełącznik light/dark + localStorage
│   ├── js/nav.js          # mobilne menu (hamburger, Escape, fokus)
│   ├── favicon.svg
│   ├── index.php
│   └── views/             # layout.html.php + szablony + partials/
└── src/
    ├── Routing.php        # router (regex, parametry ścieżki)
    ├── controllers/       # AppController + kontrolery widoków
    ├── Models/            # Booking — readonly model rezerwacji
    ├── Validation/        # BookingValidator — reguły formularza
    └── Support/           # TutorCatalog, Session, BookingStore
```

Przepływ żądania: `public/index.php` → `App\Routing` → kontroler → `AppController::render()` → widok → `layout.html.php`.

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

Na obecnym etapie brak endpointów JSON i testów automatycznych — planowane w kolejnych laboratoriach. Widoki są renderowane serwerowo w PHP, stylowanie znajduje się w `public/css/tokens.css` i `public/css/style.css`, motyw obsługuje `public/js/themes.js`, a mobilne menu `public/js/nav.js`.

## Motyw light/dark

Domyślnie strona korzysta z ustawienia systemowego (`prefers-color-scheme`). Kliknięcie przycisku w nagłówku zapisuje wybór w `localStorage` pod kluczem `maturakorki-theme`; kolejne wejścia go respektują. Motyw jest ustawiany jeszcze w `<head>`, przed renderowaniem body, żeby uniknąć mignięcia jasnej strony.

## Autorzy

- Bartosz Zięba — [@BartoszZieba](https://github.com/BartoszZieba)

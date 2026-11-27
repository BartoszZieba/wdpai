# MaturaKorki — korepetycje z matematyki do matury

Projekt zaliczeniowy z przedmiotu **Projektowanie Aplikacji Internetowych (WDPAI)**.

Aplikacja internetowa dla maturzystów, którzy szukają korepetytora z matematyki. Pozwala filtrować profile po poziomie i dziale, sprawdzić opinie, zarezerwować termin i zarządzać lekcjami w panelu ucznia.

> Etap Lab 7/8: dane korepetytorów, terminów, opinii i rezerwacji są w PostgreSQL, a aplikacja korzysta z PDO, encji i repozytoriów. Formularz rezerwacji zapisuje dane w bazie w transakcji i blokuje wybrany termin. Formularze logowania i rejestracji są nadal UI-only — prawdziwe konta pojawią się w Lab 9.

## Funkcje

| Obszar | Co robi |
|---|---|
| Strona główna | Landing z wyszukiwarką i polecanymi korepetytorami (`/`) |
| Wyniki | Lista profili + filtry poziomu i działu (`/tutors`) |
| Profil | Profil korepetytora, opinie i terminy (`/tutors/{id}`) |
| Rezerwacja | Formularz POST: termin, dane, notatka, zgoda; walidacja, CSRF i zapis w transakcji (`/booking`) |
| Potwierdzenie | Numer zgłoszenia i status „Oczekuje na akceptację” (`/booking/success`) |
| Panel ucznia | Najbliższe lekcje, historia i opinie z bazy (`/dashboard`) |
| Konta | Formularze logowania (`/login`) i rejestracji (`/register`); walidacja i CSRF, bez zapisu do bazy |
| Motyw | Przełącznik light/dark w nagłówku, zapamiętywany w `localStorage` |
| Nawigacja mobilna | Hamburger, panel pełnoekranowy, obsługa `Escape` i fokusu |
| Druk | Osobny widok `@media print` bez nawigacji i formularzy |
| Obsługa błędów | 404 dla nieznanych adresów, 500 dla wyjątków aplikacji |

## Tech stack

| Warstwa | Technologie |
|---|---|
| Backend | PHP 8.3 (PHP-FPM), autorski routing MVC |
| Serwer HTTP | nginx (FastCGI) |
| Baza danych | PostgreSQL 16, PDO, SQL (schemat + dane demo w `database/`) |
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

Baza inicjalizuje się automatycznie przy pierwszym uruchomieniu wolumenu (`database/001_schema.sql`, `database/002_seed.sql`). Aby odtworzyć bazę od zera:

```bash
docker compose down -v
docker compose up -d --build
```

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
| GET | `/login` | `SecurityController::login` |
| POST | `/login` | `SecurityController::loginSubmit` |
| GET | `/register` | `SecurityController::register` |
| POST | `/register` | `SecurityController::registerSubmit` |
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

> Rezerwacja jest zapisywana w PostgreSQL przez `BookingRepository::save()` w transakcji. Wybrany termin jest blokowany przez `SELECT ... FOR UPDATE`; drugie równoległe żądanie na ten sam slot kończy się błędem „Ten termin został właśnie zajęty”.

## Konta (UI przed bazą)

Strony `/login` i `/register` mają pełne formularze, walidację serwerową, CSRF i przekierowania PRG. Nie tworzą jeszcze kont i nie logują użytkownika — po poprawnym wysłaniu pokazują komunikat, że backend kont zostanie podłączony w Lab 9. Rejestracja pozwala wybrać rolę ucznia lub korepetytora (`/register?role=tutor`).

Szczegóły: `docs/project/07-auth-ui.md`.

## Struktura projektu

```
.
├── composer.json          # autoloading PSR-4
├── docker-compose.yaml
├── database/              # 001_schema.sql + 002_seed.sql (init PostgreSQL)
├── docker/                # obrazy nginx, PHP, PostgreSQL
├── public/                # jedyny publiczny katalog (front controller)
│   ├── css/tokens.css     # zmienne: kolory, typografia, odstępy, promienie
│   ├── css/style.css      # komponenty, widoki, RWD, druk, motyw ciemny
│   ├── js/themes.js       # przełącznik light/dark + localStorage
│   ├── js/nav.js          # mobilne menu (hamburger, Escape, fokus)
│   ├── favicon.svg
│   ├── index.php
│   └── views/             # layout.html.php + szablony + partials/ + auth/
└── src/
    ├── Routing.php        # router (regex, parametry ścieżki)
    ├── controllers/       # AppController + kontrolery widoków + SecurityController
    ├── Database.php       # połączenie PDO z PostgreSQL
    ├── Models/            # Tutor, Booking — encje readonly
    ├── Repository/        # TutorRepository, BookingRepository — SQL i mapowanie
    ├── Exceptions/        # SlotUnavailableException
    ├── Validation/        # BookingValidator, AuthValidator — reguły formularzy
    └── Support/           # Session (CSRF, flash); dane są już w DB
```

Przepływ żądania: `public/index.php` → `App\Routing` → kontroler → `AppController::render()` → widok → `layout.html.php`. Zależności (PDO i repozytoria) są składane w `public/index.php` i przekazywane kontrolerom przez fabrykę w routerze.

Dane korepetytorów, terminów, opinii i rezerwacji pochodzą z PostgreSQL. Schemat i seed: `database/001_schema.sql` i `database/002_seed.sql`; szczegóły: `docs/project/08-lab7-8-database.md`.

## Konfiguracja

Wszystkie sekrety i parametry środowiska trzymamy w `.env` (ignorowanym przez Git). Wzór: `.env.example`.

| Zmienna | Opis |
|---|---|
| `APP_PORT` | port aplikacji (domyślnie 8080) |
| `POSTGRES_*` | dane bazy PostgreSQL (kontener `db`) |
| `DB_*` | wewnętrzne dane połączenia PHP → PostgreSQL; ustawiane w `docker-compose.yaml` |
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

Brak endpointów JSON i testów automatycznych — planowane w kolejnych laboratoriach. Widoki są renderowane serwerowo w PHP, stylowanie znajduje się w `public/css/tokens.css` i `public/css/style.css`, motyw obsługuje `public/js/themes.js`, a mobilne menu `public/js/nav.js`. Testy Lab 7/8: `docs/project/08-lab7-8-database.md`.

## Motyw light/dark

Domyślnie strona korzysta z ustawienia systemowego (`prefers-color-scheme`). Kliknięcie przycisku w nagłówku zapisuje wybór w `localStorage` pod kluczem `maturakorki-theme`; kolejne wejścia go respektują. Motyw jest ustawiany jeszcze w `<head>`, przed renderowaniem body, żeby uniknąć mignięcia jasnej strony.

## Autorzy

- Bartosz Zięba — [@BartoszZieba](https://github.com/BartoszZieba)

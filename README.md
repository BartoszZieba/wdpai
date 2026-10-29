# WDPAI — aplikacja internetowa

Projekt zaliczeniowy z przedmiotu **Projektowanie Aplikacji Internetowych (WDPAI)**.
Repozytorium zawiera autorski, lekki szkielet aplikacji w architekturze MVC (PHP + nginx + PostgreSQL), uruchamiany w Docker Compose.

> **Temat projektu:** do uzupełnienia po zatwierdzeniu prototypu (problem, odbiorcy, proponowane rozwiązanie).

## Funkcje

| Obszar | Co robi |
|---|---|
| Strona główna | Widok startowy aplikacji (`/`) |
| Lista projektów | Widok listy (`/projects`) |
| Szczegóły projektu | Widok z parametrem `id` z adresu (`/projects/{id}`) |
| Obsługa 404 | Widok błędu dla nieznanych adresów |

## Tech stack

| Warstwa | Technologie |
|---|---|
| Backend | PHP 8.3 (PHP-FPM), autorski routing MVC |
| Serwer HTTP | nginx (FastCGI) |
| Baza danych | PostgreSQL 16 |
| Konteneryzacja | Docker Compose |
| Autoloading | Composer (PSR-4) |
| Narzędzia | Mailpit, pgAdmin, Ollama |

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

## Struktura projektu

```
.
├── composer.json          # autoloading PSR-4
├── docker-compose.yaml
├── docker/                # obrazy nginx, PHP, PostgreSQL
├── public/                # jedyny publiczny katalog (front controller)
│   ├── index.php
│   └── views/             # szablony .html.php
└── src/
    ├── Routing.php        # router (regex, parametry ścieżki)
    └── controllers/       # AppController + kontrolery
```

Przepływ żądania: `public/index.php` → `App\Routing` → kontroler → `AppController::render()` → widok.

## Zasady developmentu

- Każda funkcja na osobnym branchu (`feature/...`, `fix/...`, `chore/...`).
- Małe, logiczne commity z prefiksem (`feat:`, `fix:`, `docs:`, `refactor:`, `chore:`).
- Zmiany trafiają do `main` przez Pull Request i **Create a merge commit** (bez squashowania).
- Sekrety wyłącznie w `.env`; do repozytorium trafia tylko `.env.example`.

## API i testy

Na obecnym etapie brak endpointów JSON i testów automatycznych — planowane w kolejnych laboratoriach.

## Autorzy

- Bartosz Zięba — [@BartoszZieba](https://github.com/BartoszZieba)

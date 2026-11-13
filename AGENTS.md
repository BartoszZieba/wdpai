# AGENTS.md

## Cel projektu

MaturaKorki — aplikacja internetowa dla maturzystów szukających korepetytora z matematyki.
Umożliwia filtrowanie profili, sprawdzanie opinii, rezerwację terminu i przeglądanie lekcji w panelu ucznia.

To projekt zaliczeniowy WDPAI. Obecny etap: routing MVC, semantyczne widoki HTML, responsywny CSS, motyw light/dark, formularze logowania i rejestracji (UI przed bazą) oraz rezerwacja POST zapisywana w sesji. Brakuje PostgreSQL i prawdziwego logowania — te elementy wchodzą w kolejnych laboratoriach.

## Architektura

Przepływ żądania:

```text
public/index.php
  → App\Routing::dispatch()
  → kontroler (App\Controller\...)
  → AppController::render()
  → public/views/*.html.php
```

- `public/index.php` — jedyny punkt wejścia i jedyne `require_once` (`vendor/autoload.php`).
- `App\Routing` — dopasowanie metody HTTP i ścieżki, parametry `{id}`, uruchomienie akcji kontrolera.
- `App\Controller\AppController` — klasa bazowa z `render()` i helperem `e()` do escapowania.
- `App\Controller\*Controller` — przygotowują dane i wybierają widok; `SecurityController` obsługuje formularze kont.
- `App\Validation\*Validator` — reguły formularzy rezerwacji i kont.
- `App\Models\Booking` + `App\Support\BookingStore` — model i tymczasowy store rezerwacji w sesji.
- `App\Support\Session` — sesja, flash i CSRF.
- `public/views/` — warstwa prezentacji, layout, partiale i escaping.
- `App\Support\TutorCatalog` — statyczne dane demonstracyjne; w kolejnych labach zastąpi je repozytorium/PDO.

## Struktura katalogów

```text
.
├── AGENTS.md
├── README.md
├── composer.json
├── docker-compose.yaml
├── docker/
├── public/
│   ├── css/tokens.css
│   ├── css/style.css
│   ├── js/nav.js
│   ├── js/themes.js
│   ├── index.php
│   └── views/
│       ├── auth/
│       └── partials/
└── src/
    ├── Routing.php
    ├── controllers/
    ├── Models/
    ├── Validation/
    └── Support/
```

## Routing

| Metoda | Ścieżka | Akcja |
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
| — | nieznany adres | `DefaultController::notFound` + 404 |

## Uruchamianie i weryfikacja

```bash
docker compose up -d --build
docker compose exec php composer dump-autoload
docker compose ps
```

Aplikacja: http://localhost:8080

Składnia PHP:

```bash
docker compose exec -T php php -l public/index.php
docker compose exec -T php php -l src/controllers/TutorController.php
```

Testy tras:

```bash
curl -I http://localhost:8080/
curl -I http://localhost:8080/tutors
curl -I http://localhost:8080/tutors/1
curl -I http://localhost:8080/tutors/999
curl -I http://localhost:8080/booking?tutor=1
curl -I http://localhost:8080/dashboard
curl -I http://localhost:8080/login
curl -I http://localhost:8080/register
```

Oczekiwane: 200 dla istniejących tras, 404 dla `/tutors/999` i nieznanych adresów.

## Konwencje kodu

- Zawsze `declare(strict_types=1);` w plikach PHP.
- Namespace `App\...`, autoloading PSR-4 przez Composera.
- Kontrolery dziedziczą po `AppController`.
- Kontroler przygotowuje dane; widok odpowiada wyłącznie za prezentację.
- Dane dynamiczne escapuj przez `$this->e(...)` (`htmlspecialchars`).
- Nie dodawaj frameworków, bibliotek ani zależności bez zgody.
- Nie zmieniaj `vendor/` ani wygenerowanych plików Composera.
- Trzymaj małe, logiczne commity z prefiksem (`feat:`, `fix:`, `refactor:`, `docs:`, `chore:`).
- Nie zmieniaj plików niezwiązanych z zadaniem.

## Bezpieczeństwo

- Nie czytaj, nie wypisuj i nie commituj sekretów z `.env`.
- Do repozytorium trafia tylko `.env.example`.
- Nie wykonuj destrukcyjnych poleceń (`down -v`, `rm -rf`, force push) bez potwierdzenia.
- Nie usuwaj historii Git ani nie squashuj commitów.
- Nie dodawaj Ollamy, API AI ani płatności, jeśli zadanie tego nie wymaga.

## Aktualny zakres

- CSS, layout, motyw i nawigacja mobilna są gotowe.
- Formularze rezerwacji i kont mają walidację serwerową, CSRF oraz PRG; rezerwacje są w sesji, nie w PostgreSQL.
- `/login` i `/register` to UI przed bazą: nie tworzą kont i nie ustawiają sesji zalogowania. Prawdziwe auth w Lab 9.
- JavaScript: `public/js/themes.js` (motyw) i `public/js/nav.js` (menu mobilne); brak Fetch API.
- Dane korepetytorów są statyczne (`TutorCatalog`).
- Ollama nie jest częścią aplikacji; pojawia się wyłącznie jako temat Lab 4.

## Definition of done

- `php -l` nie zgłasza błędów.
- Wszystkie istniejące trasy zwracają oczekiwane 200, a nieznane 404.
- Zmiana ma mały, czytelny diff.
- `git diff` pokazuje tylko pliki związane z zadaniem.
- Po zmianie tras sprawdzono stronę w przeglądarce.
- Commit ma opisowy message; zmiany idą przez PR i merge commit.

# AGENTS.md

## Cel projektu

MaturaKorki — aplikacja internetowa dla maturzystów szukających korepetytora z matematyki.
Umożliwia filtrowanie profili, sprawdzanie opinii, rezerwację terminu i przeglądanie lekcji w panelu ucznia.

To projekt zaliczeniowy WDPAI. Obecny etap: routing MVC, semantyczne widoki HTML i dane demonstracyjne. Bez CSS, bazy danych i logowania — te elementy wchodzą w kolejnych laboratoriach.

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
- `App\Controller\*Controller` — przygotowują dane i wybierają widok.
- `public/views/` — warstwa prezentacji, partiale i escaping.
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
│   ├── index.php
│   └── views/
│       └── partials/
└── src/
    ├── Routing.php
    ├── controllers/
    └── Support/
```

## Routing

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/` | `DefaultController::index` |
| GET | `/tutors` | `TutorController::index` |
| GET | `/tutors/{id}` | `TutorController::show` |
| GET | `/booking` | `BookingController::index` |
| GET | `/dashboard` | `DashboardController::index` |
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

- Brak CSS — stylowanie w Lab 3.
- Brak bazy danych, auth i trwałej rezerwacji — kolejne laba.
- Formularze są semantyczne, ale część działa tylko po stronie GET.
- Dane korepetytorów są statyczne (`TutorCatalog`).
- Ollama nie jest częścią aplikacji; pojawia się wyłącznie jako temat Lab 4.

## Definition of done

- `php -l` nie zgłasza błędów.
- Wszystkie istniejące trasy zwracają oczekiwane 200, a nieznane 404.
- Zmiana ma mały, czytelny diff.
- `git diff` pokazuje tylko pliki związane z zadaniem.
- Po zmianie tras sprawdzono stronę w przeglądarce.
- Commit ma opisowy message; zmiany idą przez PR i merge commit.

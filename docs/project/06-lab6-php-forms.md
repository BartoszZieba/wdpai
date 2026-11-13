# Lab 6 — formularze, HTTP, walidacja i obsługa błędów

Data: 2026-11-09  
Zakres: Lab 6 z API `subject/16` — „PHP w praktyce: formularze, żądania HTTP, walidacja danych, przekierowania i obsługa błędów”.  
Materiały: trzy PDF-y „PHP — podstawy”, „PHP — podejście obiektowe”, „PHP — dobre praktyki”.

## 1. Co zostało zrobione

Formularz rezerwacji przeszedł z `GET` (tylko podgląd) na pełny przepływ:

1. `GET /booking` — formularz z wybranym terminem.
2. `POST /booking` — walidacja po stronie serwera, CSRF.
3. Sukces → `303 See Other` → `GET /booking/success` (PRG).
4. Błąd → `303` z powrotem do formularza, komunikaty i wpisane wartości w sesji.
5. Nowa rezerwacja trafia też do panelu `GET /dashboard`.

## 2. Routing

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/booking` | `BookingController::index` |
| POST | `/booking` | `BookingController::store` |
| GET | `/booking/success` | `BookingController::success` |

`GET /booking/success` bez zapisanej rezerwacji przekierowuje na `/tutors`.

## 3. Pliki

| Plik | Rola |
|---|---|
| `src/controllers/BookingController.php` | odczyt formularza, zapis, walidacja, PRG, 404 |
| `src/Validation/BookingValidator.php` | normalizacja i reguły pól |
| `src/Models/Booking.php` | readonly model rezerwacji |
| `src/Support/BookingStore.php` | tymczasowy magazyn w sesji |
| `src/Support/Session.php` | start sesji, flash, CSRF |
| `src/controllers/AppController.php` | wspólny `redirect()` |
| `src/controllers/DefaultController.php` | `serverError()` — 500 |
| `public/index.php` | start sesji, trasy POST, globalny `try/catch` |
| `public/views/booking.html.php` | formularz, błędy, CSRF, consent |
| `public/views/booking-success.html.php` | potwierdzenie |
| `public/views/server-error.html.php` | widok 500 |
| `public/css/style.css` | alerty, błędy pól, checkbox, karta sukcesu |
| `public/css/tokens.css` | `--color-danger-soft`, `--color-success-soft` |

## 4. Walidacja

| Pole | Reguła | Komunikat |
|---|---|---|
| `name` | wymagane, 3–80 znaków | „Imię i nazwisko musi mieć od 3 do 80 znaków.” |
| `email` | wymagane, ≤120, `FILTER_VALIDATE_EMAIL` | „Podaj poprawny adres e-mail.” |
| `slot` | wymagane, musi być na liście slotów korepetytora | „Wybierz termin z listy dostępnych godzin.” |
| `note` | ≤300 znaków, opcjonalne | „Notatka może mieć maksymalnie 300 znaków.” |
| `consent` | musi być zaznaczone | „Zaakceptuj zasady rezerwacji.” |
| CSRF | token z sesji, `hash_equals` | „Sesja wygasła. Odśwież stronę i wyślij formularz ponownie.” |

Wartości są przycinane, ale nie „naprawiane” po stronie serwera. Wszystkie wyjścia przechodzą przez `AppController::e()` (`htmlspecialchars`).

## 5. Bezpieczeństwo

- CSRF: 32-bajtowy token w sesji + ukryte pole `csrf_token`.
- Ciasteczko sesji: `HttpOnly`, `SameSite=Lax`, `Secure` przy HTTPS.
- Brak SQL — dane są w sesji, więc na tym etapie nie ma SQL injection.
- Walidacja zawsze na serwerze; `novalidate` w HTML nie zastępuje walidacji.
- PRG zapobiega ponownemu POST po odświeżeniu.
- `Booking` ma typowane, readonly pola; widok nie zapisuje danych.
- `try/catch` w front controllerze loguje wyjątek i pokazuje 500 bez stack trace.

## 6. Ograniczenia etapu

- Rezerwacje są w sesji, nie w PostgreSQL — znikają po wyczyszczeniu ciasteczek/restarcie sesji.
- Brak logowania i ról; każdy może wysłać formularz.
- Brak maila do korepetytora (Lab 13).
- Brak anulowania/akceptacji rezerwacji (Lab 9/P4).
- Panel pokazuje seed + nowe rezerwacje z sesji, żeby przepływ był widoczny.

## 7. Testy wykonane

```bash
docker compose exec -T php php -l public/index.php
docker compose exec -T php php -l src/controllers/BookingController.php
docker compose exec -T php php -l src/Validation/BookingValidator.php
docker compose exec -T php php -l src/Models/Booking.php
```

Wynik: brak błędów składni.

HTTP (Docker Compose: nginx + PHP 8.3.36, `http://localhost:8080`):

| Test | Wynik |
|---|---|
| `GET /booking` | 200, formularz z CSRF |
| `GET /booking?tutor=999` | 404 |
| `POST /booking` — błędne dane | 303 → `/booking?tutor=1`; błędy i stare wartości |
| `POST /booking` — poprawne dane | 303 → `/booking/success` |
| `GET /booking/success` po zapisie | 200, numer `BK-…`, status „Oczekuje na akceptację” |
| `GET /booking/success` bez zapisu | 303 → `/tutors` |
| `POST /booking` — zły CSRF | 303 → formularz + „Sesja wygasła…” |
| `GET /dashboard` po zapisie | 200, nowa rezerwacja na początku listy |

Przeglądarka (Chrome/Playwright, 360/390/768/1280): brak poziomego scrolla na formularzu, błędach i potwierdzeniu; checkbox i przyciski mają widoczny focus.

## 8. Demo

1. Wejdź na `/tutors/1`.
2. Kliknij „Zarezerwuj termin”.
3. Wybierz slot, wpisz imię, e-mail, zaznacz zgodę.
4. Wyślij — zobacz potwierdzenie i numer zgłoszenia.
5. Wejdź w „Moje lekcje” — rezerwacja jest na górze jako „Oczekuje na akceptację”.
6. Wróć do formularza i wyślij puste/błędne dane — zobacz alert i błędy pól.

## 9. Powiązanie z Lab 15

- kryterium 9 (HTML/formularze): obsłużone,
- kryterium 13 (PHP): typy, `strict_types`, walidacja, brak warningów,
- kryterium 20–24: sesja jest, ale brak auth/ról — dopiero Lab 9,
- kryterium 27 (security): CSRF i escaping są, pełne Bingo później.

# Konta — formularze przed bazą danych

## Status

Gotowy jest **interfejs** logowania i rejestracji. To nie jest jeszcze działające uwierzytelnianie: nie ma tabeli `users`, hashy haseł ani sesji zalogowanego użytkownika. Formularze walidują dane i pokazują komunikat, że backend zostanie podłączony w Lab 7/9.

## Routing

| Metoda | Ścieżka | Metoda kontrolera |
|---|---|---|
| GET | `/login` | `SecurityController::login` |
| POST | `/login` | `SecurityController::loginSubmit` |
| GET | `/register` | `SecurityController::register` |
| POST | `/register` | `SecurityController::registerSubmit` |

## Pliki

- `src/controllers/SecurityController.php` — widoki, CSRF, flash, przekierowania 303.
- `src/Validation/AuthValidator.php` — normalizacja i reguły formularzy.
- `public/views/auth/login.html.php` — strona logowania.
- `public/views/auth/register.html.php` — strona rejestracji z wyborem roli.
- `public/css/style.css` — sekcja `15b. Logowanie i rejestracja`.
- `public/views/partials/header.html.php` — „Zaloguj się” prowadzi do `/login`.

## Logowanie

Pola: e-mail, hasło.

Walidacja:

- e-mail wymagany, poprawny, maks. 120 znaków,
- hasło wymagane.

Po poprawnym wysłaniu pojawia się komunikat, że logowanie będzie aktywne po podłączeniu bazy. Nie jest ustawiana żadna flaga zalogowania.

## Rejestracja

Pola: imię i nazwisko, e-mail, hasło, powtórzenie hasła, rola (`student` / `tutor`), zgoda.

Walidacja:

- imię i nazwisko: 3–80 znaków,
- e-mail: poprawny, maks. 120 znaków,
- hasło: minimum 8 znaków,
- powtórzenie hasła: musi być identyczne,
- rola: tylko `student` lub `tutor`,
- zgoda: wymagana.

Link `/register?role=tutor` ustawia domyślnie rolę korepetytora (używają go CTA na stronie głównej i w stopce).

## Bezpieczeństwo

- CSRF jest sprawdzany przez `Session::verifyCsrf()` i `hash_equals()`.
- Błędy oraz wpisane dane wracają przez sesję (PRG, `303`).
- Hasła **nie są** zapisywane w sesji ani w logach.
- Formularze mają `novalidate`, ale zachowują atrybuty HTML (`required`, `minlength`, `maxlength`, `type="email"`) jako wsparcie przeglądarki.

## Test ręczny

```bash
docker compose up -d --build
```

- `http://localhost:8080/login` — formularz logowania,
- `http://localhost:8080/register` — formularz rejestracji,
- `http://localhost:8080/register?role=tutor` — domyślnie korepetytor,
- wyślij puste/niepoprawne dane — błędy przy polach i podsumowanie,
- wyślij poprawne dane — komunikat o etapie przed bazą.

Sprawdzone: `php -l`, HTTP 200 dla obu stron, walidacja błędów, CSRF, przekierowania 303, brak poziomego przewijania przy 390 px.

## Następny krok — Lab 9

1. Tabela `users` (`id, name, email UNIQUE, password_hash, role, created_at`).
2. `UserRepository` + `AuthService` z `password_hash()` / `password_verify()`.
3. Prawdziwe `login()`/`register()`/`logout()`, `session_regenerate_id(true)`.
4. Role `student/tutor/admin`, guardy tras, `401/403`.
5. Komunikaty błędów bez ujawniania, czy e-mail istnieje.
6. Testy jednostkowe walidatora i serwisu auth.

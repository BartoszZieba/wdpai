# Motyw light/dark

## Zakres

Przełącznik motywu w nagłówku wszystkich widoków. Funkcja jest niezależna od Lab 3, ale korzysta z tokenów CSS i wspólnych partiali.

## Pliki

- `public/js/themes.js` — logika motywu, `localStorage`, preferencja systemowa.
- `public/views/partials/theme-toggle.html.php` — dostępny przycisk z ikonami księżyca i słońca.
- `public/views/layout.html.php` — skrypt ładowany w `<head>` z `defer`.
- `public/css/style.css` — tokeny `[data-theme="dark"]`, styl przycisku, korekty komponentów z twardymi kolorami.

## Zachowanie

1. Pierwsze wejście: motyw z `prefers-color-scheme` (domyślnie jasny, jeśli brak wsparcia).
2. Klik: najpierw `alert('Witaj')` (demonstracja `defer`), po zamknięciu alertu przełączenie jasny/ciemny i zapis w `localStorage` (`maturakorki-theme`).
3. Kolejne wejście: zapisany wybór ma pierwszeństwo przed systemem.
4. Zmiana preferencji systemowej działa tylko wtedy, gdy użytkownik nie wybrał motywu ręcznie.
5. `meta[name="theme-color"]` zmienia się razem z motywem.
6. Bez JavaScriptu strona pozostaje w jasnym motywie.

## Dostępność

- Przycisk ma `type="button"`, `aria-label="Tryb ciemny"` i `aria-pressed`.
- Etykieta `title` mówi, co zrobi kliknięcie: „Włącz tryb ciemny” / „Włącz tryb jasny”.
- Rozmiar przycisku to 44 × 44 px; focus korzysta z globalnego `:focus-visible` (3 px, offset 3 px).
- Ikony są `aria-hidden="true"`, więc czytnik ekranu czyta tylko stan przycisku.

## Weryfikacja

- `node --check public/js/themes.js` — bez błędów.
- `php -l` dla zmienionych partiali — bez błędów.
- Playwright/Chrome: alert, przełączenie, reload, `localStorage`, systemowy dark, brak poziomego scrolla i widoczność wszystkich linków nawigacji na 320/360/390/768/900/1024/1280/1440 px.
- Ciemne zrzuty: `shots-theme/home-dark-desktop.png`, `home-dark-mobile.png`, `booking-dark-mobile.png`, `dashboard-dark-mobile.png` (poza repozytorium).

## Ograniczenia

- Brak przełącznika w panelu administracyjnym (panel jeszcze nie istnieje).
- Brak audytu kontrastu WCAG dla całego projektu — osobny raport w Lab 19.
- Motyw nie jest zapisywany w bazie; to ustawienie przeglądarki, nie konta.

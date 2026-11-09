# Wykłady CSS — wdrożenie w projekcie

## Źródła

- Wykład 1: „W03 — wprowadzenie do CSS” (transkrypcja w `lecture1.txt`).
- Wykład 2: „CSS: pozycjonowanie relatywne, absolutne, fixed, flex-wrap, media queries”.
- Wykład 1 zamyka się prośbą o wdrożenie zmian w projektach i przerobienie teorii/zadań z **Laboratorium 3**.

## Co zostało zmienione

### 1. Wspólny layout zamiast powtarzanego `<head>`

- `public/views/layout.html.php` — jeden dokument HTML dla wszystkich widoków: `head`, nagłówek, `$content`, stopka, skrypt motywu/nawigacji, przycisk „do góry”.
- `AppController::render()` — buforuje widok (`ob_start()`), a następnie dołącza layout; widoki zawierają tylko treść strony.
- Usunięte: `partials/head.html.php`, `partials/foot.html.php`.
- Warianty nagłówka/stopki: `public`, `minimal` (rezerwacja), `app` (panel ucznia) — przekazywane z kontrolerów przez `headerVariant` / `footerVariant`.

### 2. Osobny plik tokenów

- `public/css/tokens.css` — wyłącznie zmienne CSS: kolory, typografia, odstępy, promienie, cienie, kontener, nagłówek, przejścia; osobny blok `[data-theme="dark"]`.
- `public/css/style.css` — reset, typografia, komponenty, widoki, RWD i druk; korzysta z tokenów.
- Oba pliki są podłączone w layoutcie przed treścią.

### 3. Nawigacja mobilna (hamburger)

- `public/views/partials/nav.html.php` — wspólna nawigacja dla wariantów `public`, `app`, `minimal`; publiczna ma `data-collapsible="true"`.
- `public/views/partials/header.html.php` — przycisk `.nav-toggle` z `aria-expanded` i `aria-controls`.
- `public/js/nav.js` — otwieranie/zamykanie, `Escape`, klik poza menu, blokada przewijania tła (`body.nav-open`), aktualizacja etykiety.
- Na telefonie panel jest pełnoekranowy; na tablecie/desktopie nawigacja jest widoczna bez przycisku.

### 4. Pozycjonowanie i nakładki

- `.avatar { position: relative; }` + `.avatar--online::after` — zielona kropka statusu jako element absolutny.
- `.back-to-top` — przycisk `position: fixed` w prawym dolnym rogu (44 × 44 px, `z-index: 40`), ukrywany na stronie rezerwacji i panelu, żeby nie zasłaniał formularzy.
- `.nav-toggle`, `.theme-toggle` i panel mobilny mają `z-index` powyżej treści; panel mobilny jest pozycjonowany absolutnie pod nagłówkiem.

### 5. Karty na Flexboxie

- `.tutor-grid` — `display: flex; flex-wrap: wrap; gap`.
- Karty: `flex: 1 1 min(100%, 22rem)`; od `64rem` dokładnie trzy kolumny (`calc((100% - 2 * gap) / 3)`).
- Dzięki temu karty zawijają się bez osobnych media queries dla każdej szerokości.

### 6. Media queries, mobile i druk

- Breakpointy: `48rem` (telefon/tablet), `64rem` (desktop/nagłówek), `30rem` (mały telefon), `20rem` (bardzo mały telefon).
- `@media print`: ukrywa nagłówek, stopkę, nawigację, przyciski, formularze i elementy pływające; czyści tła, ustawia czarny tekst, marginesy `@page` i `break-inside: avoid` dla kart.
- `prefers-reduced-motion` — wyłącza animacje i płynne przewijanie.
- Sprawdzone szerokości: 320, 360, 390, 768, 1024, 1280, 1440 px; brak poziomego przewijania.

### 7. Ikony

Zamiast zewnętrznego Font Awesome użyto lekkich **inline SVG** (menu, słońce/księżyc, lupa, strzałka do góry). Dzięki temu nie ma dodatkowej zależności sieciowej, a ikony dziedziczą `currentColor` i są dostępne (`aria-hidden`, widoczne etykiety tekstowe).

## Czego nie zmieniano

- Nie dodano logowania ani formularza e-mail — authentication pojawi się w kolejnym etapie; wzorce Flexbox/`100vh` z wykładu wykorzystano w istniejących widokach.
- Nie dodano zewnętrznej biblioteki ikon ani frameworka CSS.
- Nie zmieniano danych demonstracyjnych `TutorCatalog`.

## Weryfikacja

```bash
php -l public/views/layout.html.php
php -l public/views/partials/header.html.php
php -l src/controllers/AppController.php
node --check public/js/nav.js
```

- Wszystkie trasy: `/`, `/tutors`, `/tutors/1`, `/booking?tutor=1`, `/dashboard`, 404 → bez błędów PHP.
- Menu: otwarcie przyciskiem, `aria-expanded=true`, `Escape` zamyka, fokus wraca na przycisk.
- Motyw: kliknięcie przełącza `data-theme`, wybór jest zapamiętywany.
- Fokus klawiatury: `outline: 3px solid #0B63CE`, offset 3 px.
- Druk: nagłówek/stopka/formularze/back-to-top są ukryte.

## Commity

- `feat: add shared layout and CSS lecture patterns` — layout, tokeny, nawigacja, nakładki, flex-wrap, druk.
- `docs: document CSS lecture implementation` — ten dokument, README i aktualizacja Lab 3.

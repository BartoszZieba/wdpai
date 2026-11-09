# Lab 3 — CSS MaturaKorki

## Zakres

Wybrany widok referencyjny: `D/01-Landing` (Figma, 1280 px). Arkusz obejmuje wszystkie widoki aplikacji, żeby prototyp i kod były spójne:

- `/` — landing,
- `/tutors` — wyniki i filtry,
- `/tutors/{id}` — profil korepetytora,
- `/booking` — rezerwacja,
- `/dashboard` — panel ucznia,
- 404.

Pliki: `public/css/tokens.css` (zmienne) i `public/css/style.css` (komponenty, widoki, RWD, druk). Podłączone w `public/views/layout.html.php`.

## Tokeny i system

- Kolory: ink `#14213D`, muted `#5C6675`, paper `#FBF8F3`, surface `#FFFFFF`, surface-alt `#F3EEE6`, primary `#1F5F5B`, primary-hover `#174A47`, primary-soft `#E3F0ED`, accent `#E8A33D`, border `#E4DED3`, border-strong `#CFC6B8`.
- Typografia: **Source Serif 4** (nagłówki) + **Inter** (UI i treść), ładowane z Google Fonts z fallbackami.
- Siatka: max 1200 px, odstępy 4/8/12/16/24/32/48/64 px, promienie 4/8/12/16 px.
- Breakpointy: 48 rem (tablet), 64 rem (desktop/nagłówek), 47.99 rem (telefon), 30 rem (mały telefon), 20 rem (bardzo mały telefon).
- Wszystkie kolory, typografia, odstępy, promienie i cienie są zmiennymi CSS w `public/css/tokens.css` (`:root` + `[data-theme="dark"]`).

## Wymagania Lab 3

| Wymaganie | Realizacja |
|---|---|
| Widok z Figmy | `D/01-Landing` + spójne pozostałe widoki |
| Zewnętrzny CSS | `public/css/tokens.css` + `public/css/style.css` |
| Min. 8 zmiennych | tokeny kolorów, fontów, odstępów, promieni, cieni |
| Typografia, kolory, odstępy, obramowania | tokeny + komponenty |
| Flexbox/Grid | header, hero, karty (flex-wrap), filtry, panel, stopka |
| Breakpoint + mobile | 48/64/47.99/20 rem + kontrola 320–1440; hamburger + panel mobilny |
| `:hover` i `:focus-visible` | przyciski, linki, nawigacja, formularze; widoczny ring 3 px |
| Małe commity | cztery commity CSS/HTML na `feature/lab3-css` |

## Weryfikacja

- `php -l` dla zmienionych szablonów: bez błędów.
- Serwer lokalny: `/`, `/tutors`, `/tutors/1`, `/booking?tutor=1`, `/dashboard` → 200; nieznany adres → 404; `/css/tokens.css`, `/css/style.css`, `/js/nav.js` → 200.
- `document.documentElement.scrollWidth == clientWidth` dla 320, 360, 390, 768, 1024, 1280 i 1440 px na wszystkich widokach — brak poziomego przewijania.
- Menu mobilne: `aria-expanded`, `Escape`, fokus; `@media print` ukrywa nawigację i formularze.
- Hover przycisku: tło `#1F5F5B` → `#174A47`.
- `:focus-visible`: `outline: 3px solid #0B63CE`, offset 3 px.
- Fonty: Inter i Source Serif 4 załadowane; nagłówki renderują się krojem szeryfowym.
- Zrzuty: `shots/` w katalogu roboczym (poza repozytorium).

## Commity

- `39a5804 feat: add base styles and landing page`
- `d60ddc8 feat: style tutor catalog and account views`
- `9130e2f feat: add responsive layouts for MaturaKorki`
- `a98f014 feat: connect views to the stylesheet`

## Wykłady CSS

Zmiany z wykładów 1–2 (layout, tokeny, hamburger, nakładki, flex-wrap, druk) opisuje `docs/project/05-lecture-css.md`.

## Następne kroki

- Lab 4: `AGENTS.md` i komponent nawigacji (część już przygotowana na branchu `feature/lab4-ai-workflow`).
- Później: baza PostgreSQL, logowanie, rezerwacje POST, testy i wdrożenie Azure.

# Projekt — dokumentacja

| Plik | Zawartość |
|---|---|
| `00-plan.md` | plan całego projektu, mapowanie 36 kryteriów Lab 15, fazy, routing, DB |
| `01-design-audit.md` | audyt finalnego eksportu Figma: wymiary, PDF, fonty, błędy P0/P1 |
| `02-panele-s6-s7.md` | różnice i zakres panelu korepetytora (S6) i admina (S7) |
| `03-lab3-css.md` | Lab 3: tokeny, layout, RWD, hover/focus, testy |
| `04-theme-toggle.md` | Lab 5: light/dark, `localStorage`, system preference |
| `05-lecture-css.md` | zmiany z wykładów CSS: layout, nawigacja, pozycjonowanie, druk |
| `06-lab6-php-forms.md` | Lab 6: POST, walidacja, CSRF, PRG, błędy, potwierdzenie |
| `07-auth-ui.md` | formularze logowania/rejestracji przed bazą; routing, walidacja, CSRF |
| `08-lab7-8-database.md` | Lab 7/8: PostgreSQL, PDO, encje, repozytoria, CRUD, transakcja, testy |
| `requirements-lab15.txt` | kopia treści Lab 15 — 36 kryteriów oceny |

## Kolejność czytania

1. `00-plan.md` — co i dlaczego robimy.
2. `01-design-audit.md` — co poprawić w Figmie przed kodowaniem.
3. `02-panele-s6-s7.md` — zakres paneli poza 10 frame’ami.

## Status

- plan: gotowy,
- audyt designu: gotowy,
- decyzje: Source Serif 4 + Inter, 1280/390, Azure, testy po stabilizacji,
- Lab 3 CSS, motyw, wykłady CSS i Lab 6: w `main`,
- formularze logowania/rejestracji: gotowe na branchu `feature/auth-ui` (UI, bez bazy),
- Lab 7/8 (PostgreSQL, PDO, encje, repozytoria, CRUD): gotowe na branchu `feature/lab7-8-database`,
- następny krok: merge/PR Lab 7/8, potem prawdziwe auth (Lab 9).

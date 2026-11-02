# Komponenty — MaturaKorki

Biblioteka do zbudowania w Figmie (`02 Components`). Każdy komponent ma warianty i stany; nic nie jest rysowane „ad hoc” na ekranie.

## Zasady ogólne

- Wszystko na **auto layout**.
- Nazwy: `Button / Primary / M / Default`.
- Stany: `default`, `hover`, `focus-visible`, `active`, `disabled`, `loading` (jeśli dotyczy).
- Target dotykowy min. **44×44 px**.
- Focus: zewnętrzny ring 3 px `color/focus`, offset 2 px.
- Ikony: Lucide 20/24, stroke 1.75.

## 1. Button

| Wariant | Wygląd | Użycie |
|---|---|---|
| `Primary` | tło `primary`, tekst biały | główne CTA |
| `Secondary` | tło `surface`, tekst `ink`, border `border` | akcje drugorzędne |
| `Ghost` | bez tła, tekst `primary` | linki akcji, „Anuluj” |
| `Danger` | tło `danger`, tekst biały | usuwanie, odrzucenie |

Rozmiary: `S` 32 px / 14 px; `M` 44 px / 16 px; `L` 52 px / 16 px.
Padding: S `12/16`, M `14/20`, L `16/24`. Radius `md` (10). Gap ikona–tekst 8.
Stany: hover `primary-hover`, active przyciemnienie 12%, disabled 40% + `not-allowed`, loading spinner + tekst.
Na mobile w formularzach: pełna szerokość.

## 2. IconButton

Kwadrat 44×44, ikona 20, radius `md`, warianty `ghost` / `secondary`. Zawsze `aria-label`.

## 3. Input

- wysokość 48, padding 12/16, radius `sm`, border 1 px,
- label nad polem (14/500), helper pod (13), error pod (13, `danger` + ikona),
- stany: default, hover (`border-strong`), focus (`primary` + ring), error, disabled, filled.
- Typy: text, email, password, search, textarea (min. 96 px).
- Placeholder tylko jako przykład, nigdy zamiast labelki.

## 4. Select

Jak Input + chevron po prawej. Lista: surface, shadow `md`, radius `md`, opcja 44 px, hover `surface-alt`, wybrana `primary-soft` + check.

## 5. SearchBar (kompozyt)

- Desktop: `[Poziom v] [Dział v] [ Szukaj korepetytora ]` w jednym pasku, gap 8, padding 8, surface, radius `lg`, shadow `md`.
- Mobile: pola stacked, CTA pełna szerokość.
- Poziom: `Dowolny poziom` / `Podstawa` / `Rozszerzenie`.
- Dział: `Dowolny dział` + lista działów maturalnych.
- Stan focus: ring na całym pasku; błąd: komunikat pod paskiem.

## 6. FilterChip

Pill 32 px, padding 8/12, border, tekst 14.
Stany: default, hover, selected (`primary-soft`, border `primary`, tekst `primary`, ikona X), disabled.
Używane w wynikach: „Rozszerzenie”, „do 120 zł”, „≥ 4.5”, „Geometria analityczna”.

## 7. TutorCard

Zawartość:
- avatar 56 (mobile) / 72 (desktop),
- imię i nazwisko, badge poziomu,
- 1–2 działy,
- ocena + liczba opinii,
- cena `120 zł/h`,
- najbliższy termin („czw. 18:00”),
- CTA „Zobacz profil” (ghost/link).

Desktop: układ poziomy w siatce 3 kolumn; mobile: pełna szerokość, avatar po lewej.
Hover: `shadow/md`, podniesienie 2 px. Cała karta klikalna, CTA także.

## 8. LessonCard

Data + godzina, druga osoba (korepetytor/uczeń), dział, status badge, cena.
Akcje zależne od statusu: `Anuluj`, `Wystaw opinię`, `Akceptuj`, `Odrzuć`, `Zakończ`.
Mobile: stack; desktop: wiersz.

## 9. ReviewCard

Gwiazdki, autor (imię + inicjał), data, treść, badge „po lekcji”.
Brak edycji po stronie użytkownika; admin może ukryć.

## 10. Badge

| Typ | Przykład | Kolory |
|---|---|---|
| Poziom | `Rozszerzenie` | `accent-soft` + `ink` |
| Poziom | `Podstawa` | `surface-alt` + `ink` |
| Tryb | `Online` | `primary-soft` + `primary` |
| Status | `Oczekuje` | `warning-soft` + `warning` |
| Status | `Zaakceptowana` | `success-soft` + `success` |
| Status | `Odrzucona` | `danger-soft` + `danger` |
| Status | `Zakończona` | `surface-alt` + `ink` |
| Status | `Anulowana` | `surface-alt` + `ink-muted` |
| Zaufanie | `Profil zatwierdzony` | `primary-soft` + `primary` + check |

Pill, wysokość 24–28, tekst 12/500.

## 11. Avatar

Rozmiary 32 / 40 / 56 / 72 / 96. Kwadrat zaokrąglony 50%.
Fallback: inicjały na `primary-soft` lub `accent-soft`, tekst 600.
Alt: „Zdjęcie profilowe — {imię}”.

## 12. Rating

- Display: 5 gwiazdek 16 px + `4.9` + `(23 opinie)`.
- Input: 5 gwiazdek 32 px, hover, selected, keyboard (radio group).
- Gwiazdki w `accent`; puste `border-strong`.

## 13. Tabs

Podkreślenie aktywne `primary` 2 px, tekst 16/600. Mobile: scroll poziomy. Używane w panelu (Najbliższe / Historia / Opinie).

## 14. SlotPicker

- Nagłówek: „Wybierz termin”.
- Rząd 7 dni (chipy), przewijany poziomo na mobile.
- Siatka godzin: 3 kolumny mobile, 4 desktop; 44 px wysokości.
- Stany: available, selected (`primary`, biały tekst), unavailable (przekreślona, `ink-muted`, disabled), loading.
- Pod spodem: „Strefa czasowa: Europe/Warsaw”.

## 15. Modal / BottomSheet

- Desktop: modal 480–560 px, radius `xl`, overlay.
- Mobile: bottom sheet, radius `xl` góra, uchwyt, max 90% wysokości.
- Zawsze: tytuł, treść, akcje, zamknięcie (X + Escape), focus trap.
- Używane: filtry mobilne, potwierdzenie anulowania, logowanie.

## 16. Toast

Success / error / info, 4 s, prawy górny (desktop) lub góra (mobile).
Tekst + ikona; nie przykrywa CTA.

## 17. Alert / InlineMessage

Warianty: info, success, warning, error. Tło soft + border + ikona + tekst. Używane w formularzach i panelach.

## 18. EmptyState

Ikona 48, tytuł H3, opis, CTA. Przykłady:
- „Brak wyników dla tych filtrów” + „Wyczyść filtry”,
- „Nie masz jeszcze lekcji” + „Znajdź korepetytora”,
- „Brak opinii” + „Opinie pojawią się po zakończonej lekcji”.

## 19. Skeleton

Karta: szare bloki `surface-alt`, shimmer wyłączony przy `prefers-reduced-motion`. Używane przy ładowaniu listy.

## 20. Pagination

Desktop: numery stron + prev/next; mobile: „Pokaż więcej” lub infinite scroll. Max 12 kart na stronę.

## 21. Navbar

- Publiczny: logo, `Jak to działa`, `Korepetytorzy`, `Dla korepetytorów`, `Zaloguj się`, CTA `Znajdź korepetytora`.
- Uczeń: logo, `Szukaj`, `Moje lekcje`, avatar.
- Korepetytor: logo, `Panel`, `Dostępność`, `Profil`, avatar.
- Admin: logo, `Moderacja`, `Użytkownicy`, `Wyloguj`.
Mobile: logo + hamburger + najważniejsze CTA. Sticky z tłem `paper` i borderem po scrollu.

## 22. Footer

4 kolumny desktop / stack mobile: opis, `Uczniowie`, `Korepetytorzy`, `Kontakt` + legal.
Linki 14 px, hover `primary`. Copyright 12 px `ink-muted`.

## 23. Breadcrumb

Tylko desktop, np. `Korepetytorzy / Michał K.`. Mobile: back arrow + tytuł.

## 24. Stepper (rezerwacja)

3 kroki: `Termin` → `Dane` → `Potwierdzenie`. Aktywny `primary`, zrobiony check, przyszły `ink-muted`. Mobile: kompaktowy „Krok 2 z 3”.

## 25. AdminListRow

Wiersz: nazwa/email, rola, status, data, akcje (`Zatwierdź`, `Ukryj`, `Zablokuj`).
Desktop tabela; mobile karta. Status jako Badge.

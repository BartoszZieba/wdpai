# Audyt eksportu Figma — 2026-11-02

Źródło: `C:/Users/Bartosz/Documents/folder_zbiorczy_pi/wdpai/figma_export/`
Zakres: 10 PNG, `MaturaKorki-prototyp.pdf`, `DESIGN.md` z designmd.me.
Wniosek ogólny: **kierunek Paper & Ink jest spójny i nadaje się do implementacji**, ale eksport ma kilka błędów do poprawy przed kodowaniem.

## 1. Pliki i wymiary

| Ekran | PNG | Wymiary | Uwaga |
|---|---|---:|---|
| S1 landing | `Strona Główna — MaturaKorki.png` | 1280×3074 | OK |
| S2 wyniki | `Wyniki Wyszukiwania — MaturaKorki.png` | 1280×1538 | OK |
| S3 profil | `Profil Korepetytora — Michał K..png` | 1280×2418 | OK |
| S4 rezerwacja | `Rezerwacja Lekcji — MaturaKorki.png` | **1296×1252** | zła szerokość i tło |
| S5 panel | `Moje lekcje — MaturaKorki.png` | **1296×1047** | zła szerokość |
| S1 mobile | `Strona Główna (Mobile) — MaturaKorki.png` | **788×8350** | 394 px @2x |
| S2 mobile | `Wyniki Wyszukiwania (Mobile) — MaturaKorki.png` | **812×4482** | 406 px @2x, overflow |
| S3 mobile | `Profil Korepetytora (Mobile) — Michał K..png` | **812×3998** | 406 px @2x |
| S4 mobile | `Rezerwacja Lekcji (Mobile) — MaturaKorki.png` | **812×1782** | 406 px @2x, clipping |
| S5 mobile | `Moje lekcje (Mobile) — MaturaKorki.png` | **812×2302** | 406 px @2x |

Standard do przyjęcia: **desktop 1280 px, mobile 390 px** (zgodnie z `DESIGN.md` i większością frame’ów). PNG mobile przy 2x powinny mieć 780 px, nie 788/812.

## 2. PDF

- 10 stron, 38 972 KB, poniżej limitu 100 MB.
- Kolejność stron: **S1 D, S3 D, S2 D, S4 D, S5 D, S1 M, S3 M, S2 M, S4 M, S5 M**.
- S2 i S3 są zamienione; kolejność powinna być S1 → S2 → S3 → S4 → S5.
- Szerokości stron: 1280, 1280, 1280, 1296, 1296, 394, 406, 406, 406, 406.
- Po poprawkach w Figmie wyeksportować ponownie w kolejności S1–S5 (najpierw wszystkie desktop, potem wszystkie mobile albo naprzemiennie — ważna jest kolejność w PDF).

## 3. Typografia i akcent

- W PNG nagłówki są **szeryfowe**, body/UI **Inter**. `DESIGN.md` podaje „Inter primary” i tylko style body; nie zebrał stylów nagłówków. To ograniczenie designmd.me, nie designu.
- `DESIGN.md` sam wymienia **Source Serif 4** jako font „used in specific contexts”; wizualnie to on odpowiada nagłówkom. Przyjmujemy: **Source Serif 4 600 / Inter 400–600**.
- Akcenty w PNG:
  - **gold `#E8A33D`** — gwiazdki ocen, górna krawędź `pending`,
  - **terracotta `#A43D00`** — badge poziomu (`ROZSZERZENIE`, `PODSTAWA`),
  - **teal `#1F5F5B`** — główne CTA i linki,
  - **forest `#003330`** — logo, wybrany slot/dzień, ciemne akcenty,
  - **ink `#14213D`** — tekst i ciemny pas CTA.
- To jest spójne między ekranami; **nie zmieniamy palety**. Docs dostosowujemy do tych ról, a nie odwrotnie.

## 4. Błędy do poprawy w Figmie

### P0 — przed kodowaniem

1. **S4 desktop — złe tło.** Ma `#F9F9F8` zamiast `#FBF8F3`; przez to szary panel odcina się od reszty.
2. **Szerokości frame’ów.** S4/S5 desktop 1296 → 1280; S1 mobile 394 → 390; S2–S5 mobile 406 → 390.
3. **S2 mobile — overflow.** Aktywne chipy (`do 120…`) i karty wychodzą poza prawą krawędź; „Sortuj” jest za wąski i łamie się na dwie linie. Ustawić chipy w jednej linii z `overflow-x: auto` albo zawijać; panel sortowania pełna szerokość / osobny rząd.
4. **S4 mobile — clipping.** Piąty dzień (`WT 03.11`) i część godzin są ucięte. Zrobić poziomy scroll z widoczną krawędzią lub siatkę 3+2; nie zostawiać uciętych elementów.
5. **PDF — kolejność.** S1, S3, S2… → S1, S2, S3, S4, S5; po eksporcie sprawdzić 10 stron.
6. **Niespójne dane.** S3 i S1: `4.9 (23 opinie)`; S4: `5.0 (42 opinie)`; S1 mobile: `4.9 (23 lekcje)`. Ustalić jedną wartość: **4.9 / 23 opinie** i użyć wszędzie.
7. **S3 — copy „lekcji próbnej”.** Wcześniejsza decyzja: brak lekcji próbnej. Zmienić np. na: „Wybierz temat, nad którym chcesz pracować podczas zajęć.”

### P1 — spójność i czytelność

8. **S5 desktop — „Anuluj” wygląda na wyłączone.** Jest jasnoszary tekst, podczas gdy mobile ma pełny przycisk. Ujednolicić: aktywny przycisk outline; disabled tylko tam, gdzie naprawdę nie można anulować.
9. **S5 desktop — pomocniczy tekst.** „Nauczyciel potwierdzi rezerwację do 24h” jest bardzo jasny; podnieść kontrast do AA.
10. **S5 avatar.** Mobile ma rdzawy `Z`, desktop ciemny teal. Ujednolicić kolor awatara.
11. **S4 header.** Jest okrągła ikona użytkownika, ale nie wiadomo, czy to gość, czy zalogowany. Dla flow rezerwacji pokazać stan zalogowanego użytkownika (avatar/inicjał) albo „Zaloguj się”.
12. **S1 mobile vs desktop.** Karta w hero ma „23 lekcje” zamiast „23 opinie”; ujednolicić z desktopem.
13. **S2 mobile — breadcrumb** jest bardzo jasny; poprawić kontrast.
14. **PDF 38 MB** — akceptowalne, ale jeśli ma iść do formularza, można zejść do ~5–10 MB przez kompresję PNG/JPEG.

## 5. Czego `DESIGN.md` nie zastępuje

- `coverage.statesFound: 0` — brak stanów pustych, błędów, hover/focus.
- `responsiveMeasured: false` — brak realnych reguł responsywnych.
- Brak tokenów nagłówków (tylko body).
- `themes.light`/`themes.dark` to wygenerowane motywy pomocnicze (`#111111`, `#818181`), a nie faktyczna paleta ekranów.
- `source.pagesAnalyzed: 1` — przeanalizowano jedną stronę, nie 10 frame’ów.

Wniosek: **`DESIGN.md` traktujemy jako pomocniczy odczyt kolorów, a nie specyfikację**. Źródłem prawdy są PNG + Figma + `docs/prototype/01-design-tokens.md`.

## 6. Co jest dobre

- Spójny warm paper/ink, bez fioletu, gradientów i 3D.
- Czytelna hierarchia: serifowe nagłówki + Inter.
- Powtarzalne karty, badge, chipy i przyciski.
- Dobrze zaprojektowane S1, S2, S3, S5 mobile; S4 ma dobry układ podsumowania i sticky CTA.
- Copy PL jest kompletne; nie ma lorem ipsum.
- Jest 5 desktop + 5 mobile, czyli wymóg Lab 2/Z1 spełniony.

## 7. Decyzje po audycie

- Font: **Source Serif 4 (nagłówki) + Inter (UI/body)**; docs aktualizujemy do Figmy.
- Akcent: **gold `#E8A33D` + terracotta `#A43D00` + teal `#1F5F5B`**; docs aktualizujemy do Figmy.
- Desktop: **1280 px**, mobile: **390 px**.
- Testy: dopiero po stabilizacji funkcjonalnej.
- Deploy: Azure (próba), do potwierdzenia publicznym URL.
- S6/S7: patrz `02-panele-s6-s7.md`.

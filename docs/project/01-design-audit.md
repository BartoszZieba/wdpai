# Audyt eksportu Figma — 2026-11-02

Źródło: `C:/Users/Bartosz/Documents/folder_zbiorczy_pi/wdpai/figma_export/`
Zakres: 10 PNG, `MaturaKorki-prototyp.pdf`, `DESIGN.md` z designmd.me.
Wniosek ogólny: **kierunek Paper & Ink jest spójny i nadaje się do implementacji**, ale eksport ma kilka błędów do poprawy przed kodowaniem.

## 1. Pliki i wymiary

| Ekran | Frame w Figmie | PNG | Uwaga |
|---|---:|---:|---|
| S1 landing | 1280×3073,5 | 1280×3074 | OK |
| S2 wyniki | 1280×1538 | 1280×1538 | OK |
| S3 profil | 1280×2417,25 | 1280×2418 | OK |
| S4 rezerwacja | 1280×1245 | 1296×1252 | PNG zawiera cień; tło poprawione |
| S5 panel | 1280×1040 | 1296×1047 | PNG zawiera cień |
| S1 mobile | 390×4174 | 788×8350 (394×4175 @2x) | PNG zawiera cień |
| S2 mobile | 390×2225 | 812×4482 (406×2241 @2x) | PNG zawiera cień; chipsy w scrollu |
| S3 mobile | 390×1992 | 812×3998 (406×1999 @2x) | PNG zawiera cień |
| S4 mobile | 390×884 | 812×1782 (406×891 @2x) | PNG zawiera cień; dni do dokończenia |
| S5 mobile | 390×1144 | 812×2302 (406×1151 @2x) | PNG zawiera cień |

**Ważne:** frame’y w Figmie mają już poprawne **1280 / 390 px**. Wcześniejsza ocena „1296/406 to zła szerokość” była błędna — PNG są o 8 px szersze, bo Figma eksportuje efekt/cień poza frame. **Nie zmieniaj frame’ów na 1296/406.** Do czystego PDF eksportuj z przycięciem albo przytnij 8 px z każdej strony.

## 2. PDF

- 10 stron, 38 972 KB, poniżej limitu 100 MB.
- Kolejność stron: **S1 D, S3 D, S2 D, S4 D, S5 D, S1 M, S3 M, S2 M, S4 M, S5 M**.
- S2 i S3 są zamienione; kolejność powinna być S1 → S2 → S3 → S4 → S5.
- Szerokości stron wynikają z eksportu z cieniem: 1280, 1280, 1280, 1296, 1296, 394, 406, 406, 406, 406; frame’y źródłowe to 1280/390.
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

1. **S4 desktop — złe tło.** Ma `#F9F9F8` zamiast `#FBF8F3`; przez to szary panel odcina się od reszty. **Status: poprawione w Figmie** (frame, Main, Footer, Header), wymaga re-eksportu.
2. **Szerokości frame’ów — nie jest błędem.** Frame’y mają 1280/390; 1296/406 to cień w PNG. **Status: zamknięte, bez zmian w Figmie.**
3. **S2 mobile — chipsy i sortowanie.** Kontrolki mają 191 + 8 + 159 = 358 px, więc **nie nachodzą na siebie**; „Sortuj” jest wyższy i łamie się na dwie linie celowo. Chipy (`do 120 zł`, `4.5+`) są w poziomym scrollu i wychodzą poza 390 px — to działający scroll, ale bez affordance. **Status: do decyzji** (dodać fade/strzałkę albo zostawić).
4. **S4 mobile — clipping dni.** Piąty dzień (`WT 03.11`) był ucięty. Karty zmniejszone do 68 px i rozstawione co 72 px (16…372), ale **po zmianie zostały przesunięte na y=290 wewnątrz `Day Chips` i są ukryte**. Trzeba ustawić ich `y=0` w kontenerze `Day Chips (Horizontally Scrollable)` i sprawdzić screenshot. **Status: w toku; limit Figma MCP uniemożliwił dokończenie.**
5. **PDF — kolejność.** S1, S3, S2… → S1, S2, S3, S4, S5; po eksporcie sprawdzić 10 stron. **Status: otwarte.**
6. **Niespójne dane.** S3 i S1: `4.9 (23 opinie)`; S4: `5.0 (42 opinie)`; S1 mobile: `4.9 (23 lekcje)`. **Status: poprawione** — S4 `4.9 (23 opinie)`, S1 mobile `(23 opinie)`.
7. **Copy „lekcji próbnej”.** W Figmie było jedno wystąpienie (S1, `1:529`): „…podczas lekcji próbnej lub cyklu spotkań.” **Status: poprawione** na „…podczas zajęć.”. W S3 nie znaleziono już tego zwrotu.

### P1 — spójność i czytelność

8. **S5 desktop — „Anuluj” wygląda na wyłączone.** Był jasny beż `#CFC6B8`; **status: poprawione** na terakotę `#A43D00` w obu miejscach. Mobile ma pełny przycisk — do ujednolicenia wizualnego później.
9. **S5 desktop — pomocniczy tekst.** „Nauczyciel potwierdzi rezerwację do 24h” jest bardzo jasny; podnieść kontrast do AA. **Status: otwarte.**
10. **S5 avatar.** Mobile ma rdzawy `Z`, desktop ciemny teal. Ujednolicić kolor awatara. **Status: otwarte.**
11. **S4 header.** Była okrągła ikona użytkownika; **status: usunięta** z S4 desktop. Zostało „Wróć do profilu”.
12. **S1 mobile vs desktop.** Karta w hero miała „23 lekcje”; **status: poprawione** na „23 opinie”.
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

## 7. Status po korektach w Figmie (2026-11-02)

- **Poprawione w Figmie:** S4 tło `#FBF8F3`; usunięta ikona gościa z S4 desktop; oceny `4.9 (23 opinie)` w S4 i S1 mobile; copy o lekcji próbnej; kolor „Anuluj” w S5.
- **W toku:** S4 mobile dni — szerokość 68 px ustawiona, ale karty mają złe `y` (290 zamiast 0) i są ukryte przez `clipsContent`; wymaga jednej poprawki `y=0` i screenshotu.
- **Zablokowane:** dalsze wywołania Figma MCP — Starter plan zwrócił limit tool calls. Po odblokowaniu: dokończyć dni, wyeksportować 10 PNG/PDF, sprawdzić kolejność.
- **Do decyzji:** S2 mobile chipsy — zostawić horizontal scroll czy dodać fade/strzałkę; nie ma nachodzenia kontrolek.

## 8. Decyzje po audycie

- Font: **Source Serif 4 (nagłówki) + Inter (UI/body)**; docs aktualizujemy do Figmy.
- Akcent: **gold `#E8A33D` + terracotta `#A43D00` + teal `#1F5F5B`**; docs aktualizujemy do Figmy.
- Desktop: **1280 px**, mobile: **390 px**.
- Testy: dopiero po stabilizacji funkcjonalnej.
- Deploy: Azure (próba), do potwierdzenia publicznym URL.
- S6/S7: patrz `02-panele-s6-s7.md`.

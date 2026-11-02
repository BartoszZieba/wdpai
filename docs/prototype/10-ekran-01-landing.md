# Ekran 01 — Landing + wyszukiwarka

## Meta

| Pole | Wartość |
|---|---|
| ID | S1 |
| Frame mobile | `M/01-Landing` — 390×844 |
| Frame desktop | `D/01-Landing` — 1280×1024 |
| Dostęp | publiczny (gość) |
| Persona | Zosia, maturzystka |
| Cel | w ≤ 5 s przekazać wartość i rozpocząć wyszukiwanie |
| Wejście | wejście z zewnątrz / logo |
| Wyjście | S2 Wyniki (`Szukaj korepetytora`) lub S3 (karta korepetytora) |
| Główne CTA | `Szukaj korepetytora` |
| Drugie CTA | `Załóż profil korepetytora` (sekcja dla korepetytorów) |

**Najważniejsze:** użytkownik od razu rozumie, że to matematyka **do matury**, a nie ogólne korepetycje, i widzi, gdzie zacząć.

## 1. Układ desktop (1280)

| # | Sekcja | Zawartość | Grid |
|---|---|---|---|
| 1 | Header | logo, 3 linki, `Zaloguj się`, CTA | 12 kol., wys. 72, sticky |
| 2 | Hero — lewa | eyebrow, H1, subhead, SearchBar, helper | 7 kol. |
| 3 | Hero — prawa | kompozycja UI: karta korepetytora + chipy terminów na siatce | 5 kol. |
| 4 | Trust strip | 3 punkty z ikonami | 3×4 kol. |
| 5 | Jak to działa | H2 + 3 kroki | 3×4 kol. |
| 6 | Polecani | H2 + 3 karty + link „Zobacz wszystkich” | 3×4 kol. |
| 7 | Dlaczego | H2 + 3 karty korzyści | 3×4 kol. |
| 8 | CTA korepetytorów | H2 + opis + przycisk na tle `ink` | 2 kol. (7/5) |
| 9 | Footer | 4 kolumny + legal | 4×3 kol. |

Sekcje 4–7 mają padding 96–128 px w pionie; maks. szerokość treści 1200 px.
Tło: hero `paper` + subtelna siatka 24 px; „Jak to działa” `surface-alt`; reszta `paper`; CTA `ink`; footer `surface-alt`.

## 2. Układ mobile (390)

- Header: logo + hamburger + `Zaloguj się` (bez pełnego menu).
- Hero: copy, SearchBar stacked, helper, kompozycja UI jako **jedna kompaktowa karta** pod wyszukiwarką.
- Trust strip: 3 wiersze z ikoną po lewej.
- Jak to działa: 3 kroki pionowo, numer w kółku.
- Polecani: 3 karty pionowo (bez poziomego scrolla — czytelność).
- Dlaczego: 3 karty pionowo.
- CTA korepetytorów: pełna szerokość, przycisk full-width.
- Footer: stacked, linki w 2 kolumnach.

## 3. Wireframe — mobile

```text
┌───────────────────────────────┐
│ MaturaKorki          ☰  Zaloguj│
├───────────────────────────────┤
│ MATEMATYKA DO MATURY          │
│ PODSTAWA I ROZSZERZENIE       │
│                               │
│ Ogarnij maturę z matematyki   │
│ z korepetytorem, który zna    │
│ Twój dział.                   │
│                               │
│ Porównaj profile, sprawdź     │
│ opinie i zarezerwuj termin    │
│ online.                       │
│                               │
│ ┌ Poziom — Dowolny v ┐        │
│ └────────────────────┘        │
│ ┌ Dział — Dowolny v ┐         │
│ └────────────────────┘        │
│ [  Szukaj korepetytora  ]     │
│ Online, w terminach, które    │
│ Ci pasują.                    │
│                               │
│ ┌───────────────────────────┐ │
│ │ (MK) Michał K.   ✓ 4.9    │ │
│ │ Rozszerzenie · 110 zł/h   │ │
│ │ najbliższy: czw. 18:00    │ │
│ └───────────────────────────┘ │
├───────────────────────────────┤
│ ✓ Profile zatwierdzane        │
│ ✓ Opinie po zakończonej lekcji│
│ ✓ Ceny i terminy jawne        │
├───────────────────────────────┤
│ Jak to działa                 │
│ ① Wybierz dział               │
│ ② Porównaj profile            │
│ ③ Zarezerwuj termin           │
├───────────────────────────────┤
│ Korepetytorzy z wolnymi       │
│ terminami                     │
│ ┌───────────────────────────┐ │
│ │ [card]                    │ │
│ ├───────────────────────────┤ │
│ │ [card]                    │ │
│ ├───────────────────────────┤ │
│ │ [card]                    │ │
│ └───────────────────────────┘ │
│ Zobacz wszystkich →           │
├───────────────────────────────┤
│ Dlaczego MaturaKorki?         │
│ [karta] [karta] [karta]       │
├───────────────────────────────┤
│ █ Uczysz matematyki?        █ │
│ █ [Załóż profil korepetytora]█ │
├───────────────────────────────┤
│ footer                        │
└───────────────────────────────┘
```

## 4. Wireframe — desktop

```text
┌─────────────────────────────────────────────────────────────────────┐
│ MaturaKorki   Jak to działa  Korepetytorzy  Dla korep.  Zaloguj     │
│                                          [Znajdź korepetytora]      │
├─────────────────────────────────────────────────────────────────────┤
│ MATEMATYKA DO MATURY · PODSTAWA I ROZSZERZENIE                     │
│                                                                     │
│ Ogarnij maturę z matematyki           ┌──────────────────────────┐  │
│ z korepetytorem, który zna Twój dział.│ (MK) Michał K.     ✓ 4.9 │  │
│                                       │ Rozszerzenie · 110 zł/h  │  │
│ Porównaj profile, sprawdź opinie      │ Geometria analityczna    │  │
│ i zarezerwuj termin online.           │ czw. 18:00  pt. 16:30    │  │
│                                       └──────────────────────────┘  │
│ ┌ Poziom — Dowolny v ┐ ┌ Dział — Dowolny v ┐ [Szukaj korepetytora]  │
│ Online, w terminach, które Ci pasują.                              │
│                                                                     │
│ ✓ Profile zatwierdzane   ✓ Opinie po lekcji   ✓ Ceny jawne          │
├─────────────────────────────────────────────────────────────────────┤
│ Jak to działa                                                       │
│ ① Wybierz dział        ② Porównaj profile       ③ Zarezerwuj termin │
├─────────────────────────────────────────────────────────────────────┤
│ Korepetytorzy z wolnymi terminami                                   │
│ [TutorCard]            [TutorCard]            [TutorCard]           │
│ Zobacz wszystkich korepetytorów →                                   │
├─────────────────────────────────────────────────────────────────────┤
│ Dlaczego MaturaKorki?                                               │
│ [karta]                [karta]                [karta]               │
├─────────────────────────────────────────────────────────────────────┤
│ █ Uczysz matematyki?                        [Załóż profil] █        │
├─────────────────────────────────────────────────────────────────────┤
│ footer: opis | Uczniowie | Korepetytorzy | Kontakt                  │
└─────────────────────────────────────────────────────────────────────┘
```

## 5. Komponenty

`Navbar`, `Button` (primary/secondary/ghost), `Select`, `SearchBar`, `TutorCard`, `Badge`, `Avatar`, `Rating`, `Footer`, ikony Lucide.

## 6. Copy PL

### Header

- Logo: **MaturaKorki**
- Linki: `Jak to działa` · `Korepetytorzy` · `Dla korepetytorów`
- `Zaloguj się`
- CTA: `Znajdź korepetytora`

### Hero

- Eyebrow: `MATEMATYKA DO MATURY · PODSTAWA I ROZSZERZENIE`
- H1: **Ogarnij maturę z matematyki z korepetytorem, który zna Twój dział.**
- Subhead: `Porównaj profile, sprawdź opinie i zarezerwuj termin online. Bez grup na Facebooku i ustalania ceny w DM.`

### Wyszukiwarka

- Label 1: `Poziom`
  - `Dowolny poziom` (domyślnie), `Podstawa`, `Rozszerzenie`
- Label 2: `Dział`
  - `Dowolny dział` (domyślnie), `Funkcje`, `Równania i nierówności`, `Wyrażenia algebraiczne`, `Ciągi`, `Trygonometria`, `Planimetria`, `Geometria analityczna`, `Stereometria`, `Prawdopodobieństwo i statystyka`, `Kombinatoryka`
- CTA: `Szukaj korepetytora`
- Helper: `Online, w terminach, które Ci pasują.`

### Trust strip

- `Profile zatwierdzane przez admina`
- `Opinie tylko po zakończonej lekcji`
- `Ceny i terminy jawne od początku`

### Jak to działa

- H2: `Jak to działa`
- 1: `Wybierz dział` — `Wskaż poziom i temat, z którym masz problem.`
- 2: `Porównaj profile` — `Cena, doświadczenie, opinie i najbliższe terminy w jednym miejscu.`
- 3: `Zarezerwuj termin` — `Wyślij zgłoszenie, a korepetytor potwierdzi je w swoim panelu.`

### Polecani korepetytorzy

- H2: `Korepetytorzy z wolnymi terminami`
- Subhead: `Sprawdzeni, z opiniami po lekcjach.`
- Karta 1: `Michał K.` · `Rozszerzenie` · `Geometria analityczna, Funkcje` · `110 zł/h` · `4.9 (23 opinie)` · `Najbliższy termin: czw. 18:00` · `Zobacz profil`
- Karta 2: `Anna W.` · `Podstawa i rozszerzenie` · `Prawdopodobieństwo, Ciągi` · `95 zł/h` · `4.8 (17 opinii)` · `Najbliższy termin: dziś 19:00` · `Zobacz profil`
- Karta 3: `Tomasz R.` · `Rozszerzenie` · `Trygonometria, Stereometria` · `130 zł/h` · `5.0 (11 opinii)` · `Najbliższy termin: pt. 16:30` · `Zobacz profil`
- Link: `Zobacz wszystkich korepetytorów →`

### Dlaczego MaturaKorki?

- H2: `Dlaczego MaturaKorki?`
- 1: `Skupienie na maturze` — `Działy i poziomy zamiast ogólnych ogłoszeń. Trafiasz do kogoś, kto uczy dokładnie tego, czego potrzebujesz.`
- 2: `Zaufanie bez zgadywania` — `Opinie wystawiają tylko uczniowie po zakończonej lekcji. Żadnych gwiazdek od znajomych.`
- 3: `Terminy bez DM` — `Rezerwacja i status w panelu. Widzisz, czy lekcja jest przyjęta, zanim zaczniesz się pakować.`

### CTA dla korepetytorów

- H2: `Uczysz matematyki?`
- Opis: `Dołącz jako korepetytor. Ustaw dostępność, przyjmuj zgłoszenia i buduj opinie.`
- CTA: `Załóż profil korepetytora`
- Link pomocniczy: `Zobacz, jak to działa`

### Footer

- Opis: `Korepetycje z matematyki do matury. Online, bez zgadywania.`
- `Uczniowie`: `Znajdź korepetytora`, `Jak to działa`, `Opinie`
- `Korepetytorzy`: `Zostań korepetytorem`, `Zasady współpracy`
- `Kontakt`: `kontakt@maturakorki.pl` *(placeholder demo)*
- Legal: `Regulamin`, `Polityka prywatności`
- `© 2026 MaturaKorki. Projekt studencki.`

## 7. Stany

| Stan | Zachowanie |
|---|---|
| Domyślny | sekcja „Polecani” pokazuje 3 karty z seeda |
| Brak polecanych | sekcja ukryta, zostaje link „Zobacz wszystkich” |
| Brak wyboru filtrów | wyszukiwanie działa jak „dowolny poziom / dowolny dział” |
| Błąd walidacji | nie dotyczy — pola mają wartość domyślną |
| Ładowanie | nie dotyczy (statyczny landing) |
| Zalogowany uczeń | header: `Moje lekcje` + avatar zamiast `Zaloguj się` |
| Zalogowany korepetytor | header: `Panel` + avatar |

## 8. Responsywność

- Desktop ≥ 1024: hero 7/5, wyszukiwarka poziomo, 3 kolumny kart.
- Tablet 768–1023: hero 1 kolumna, wyszukiwarka poziomo, karty 2 kolumny.
- Mobile < 768: wszystko 1 kolumna, wyszukiwarka stacked, karty pełna szerokość.
- Brak horizontal scrolla przy 360 px.
- Header sticky; na mobile menu w bottom sheet lub full-screen overlay.

## 9. Dostępność

- H1 tylko jeden na stronie.
- Selecty mają widoczne labelki (nie tylko placeholder).
- Kolejność fokusu: logo → linki → `Zaloguj` → CTA → wyszukiwarka → karty.
- Ring `color/focus` 3 px, offset 2.
- Karty: całość klikalna, ale link „Zobacz profil” jest prawdziwym linkiem.
- Kontrast tekstu min. AA.
- Ikony trust strip dekoracyjne (`aria-hidden`), tekst niesie znaczenie.

## 10. Prompt do Stitcha

### Globalny styl (wklej przed promptem ekranu)

```text
Design a responsive web app called "MaturaKorki" — a Polish marketplace for high-school math tutoring for the matura exam. Visual direction: warm academic "paper and ink". Background #FBF8F3, primary text #14213D, primary action #1F5F5B, accent #E8A33D (use only with dark text), borders #E4DED3, cards #FFFFFF, muted text #5C6675. Headings: Source Serif 4 serif, 600. UI/body: Inter. Generous whitespace, strong hierarchy, 12-column grid, max content width 1200px, 8px card radius, soft shadows. Icons: Lucide, 1.75 stroke. Mobile-first. No gradients, no purple, no 3D, no emoji, no generic AI illustrations, no stock handshake photos. Use the exact Polish copy provided — do not translate it, do not add extra sections, do not use lorem ipsum.
```

### Desktop (1280×1024)

```text
Design a desktop landing page (1280x1024) for MaturaKorki.

1. Header (72px, sticky, background #FBF8F3, bottom border #E4DED3): wordmark "MaturaKorki" left; links "Jak to działa", "Korepetytorzy", "Dla korepetytorów"; "Zaloguj się"; primary button "Znajdź korepetytora".
2. Hero, two columns (7/5), background #FBF8F3 with a very subtle 24px graph-paper grid:
   Left: eyebrow "MATEMATYKA DO MATURY · PODSTAWA I ROZSZERZENIE"; H1 "Ogarnij maturę z matematyki z korepetytorem, który zna Twój dział."; subhead "Porównaj profile, sprawdź opinie i zarezerwuj termin online. Bez grup na Facebooku i ustalania ceny w DM."; horizontal search bar with two selects ("Poziom — Dowolny poziom", "Dział — Dowolny dział") and primary button "Szukaj korepetytora"; helper text "Online, w terminach, które Ci pasują."
   Right: a layered UI composition — a white tutor card (avatar initials "MK", "Michał K.", verified check, "4.9", "Rozszerzenie", "110 zł/h", "Geometria analityczna", "Najbliższy termin: czw. 18:00") and 2–3 floating time-slot chips ("wt. 17:00", "czw. 18:00", "pt. 16:30") on the graph grid. No photo, no 3D.
3. Trust strip under hero, 3 columns with Lucide icons and text: "Profile zatwierdzane przez admina", "Opinie tylko po zakończonej lekcji", "Ceny i terminy jawne od początku".
4. "Jak to działa" section on #F3EEE6: H2 and 3 numbered steps — "1 Wybierz dział / Wskaż poziom i temat, z którym masz problem.", "2 Porównaj profile / Cena, doświadczenie, opinie i najbliższe terminy w jednym miejscu.", "3 Zarezerwuj termin / Wyślij zgłoszenie, a korepetytor potwierdzi je w swoim panelu."
5. "Korepetytorzy z wolnymi terminami" with subhead "Sprawdzeni, z opiniami po lekcjach." and 3 tutor cards in a row: "Michał K. — Rozszerzenie — Geometria analityczna, Funkcje — 110 zł/h — 4.9 (23 opinie) — Najbliższy termin: czw. 18:00", "Anna W. — Podstawa i rozszerzenie — Prawdopodobieństwo, Ciągi — 95 zł/h — 4.8 (17 opinii) — Najbliższy termin: dziś 19:00", "Tomasz R. — Rozszerzenie — Trygonometria, Stereometria — 130 zł/h — 5.0 (11 opinii) — Najbliższy termin: pt. 16:30". Each card has a ghost link "Zobacz profil". Below: link "Zobacz wszystkich korepetytorów →".
6. "Dlaczego MaturaKorki?" with 3 benefit cards: "Skupienie na maturze / Działy i poziomy zamiast ogólnych ogłoszeń. Trafiasz do kogoś, kto uczy dokładnie tego, czego potrzebujesz.", "Zaufanie bez zgadywania / Opinie wystawiają tylko uczniowie po zakończonej lekcji. Żadnych gwiazdek od znajomych.", "Terminy bez DM / Rezerwacja i status w panelu. Widzisz, czy lekcja jest przyjęta, zanim zaczniesz się pakować."
7. Full-width dark ink (#14213D) CTA band: "Uczysz matematyki?" + "Dołącz jako korepetytor. Ustaw dostępność, przyjmuj zgłoszenia i buduj opinie." + white button "Załóż profil korepetytora" + text link "Zobacz, jak to działa".
8. Footer on #F3EEE6, 4 columns: brand + "Korepetycje z matematyki do matury. Online, bez zgadywania."; "Uczniowie" (Znajdź korepetytora, Jak to działa, Opinie); "Korepetytorzy" (Zostań korepetytorem, Zasady współpracy); "Kontakt" (kontakt@maturakorki.pl). Bottom line: "Regulamin", "Polityka prywatności", "© 2026 MaturaKorki. Projekt studencki."

Use a 12-column grid, 1200px max width, 24px gutters. Cards: white, 1px #E4DED3 border, 8px radius, 24px padding. Buttons: 44px height, 4px radius. Keep the hero CTA above the fold at 1280x900.
```

### Mobile (390×844)

```text
Adapt the MaturaKorki landing page to a 390x844 mobile screen, mobile-first.

Header: wordmark left, hamburger and "Zaloguj się" right.
Hero: eyebrow, H1, subhead, then stacked selects ("Poziom — Dowolny poziom", "Dział — Dowolny dział") and a full-width primary button "Szukaj korepetytora"; helper text below.
Below the search: one compact tutor card ("MK", "Michał K.", "4.9", "Rozszerzenie", "110 zł/h", "Najbliższy termin: czw. 18:00").
Trust strip: 3 stacked rows with icons.
"Jak to działa": vertical numbered steps.
"Korepetytorzy z wolnymi terminami": 3 full-width cards stacked, ghost link "Zobacz profil".
"Dlaczego MaturaKorki?": 3 stacked cards.
Dark CTA band: full-width button "Załóż profil korepetytora".
Footer: stacked, links in 2 columns.
No horizontal scroll at 360px. Touch targets at least 44x44. Keep the same tokens and Polish copy.
```

## 11. Checklista akceptacji

- [ ] H1 i wyszukiwarka widoczne bez scrolla na desktopie 1280×900
- [ ] Dwa selecty: poziom i dział, z opcją „Dowolny”
- [ ] Jedno główne CTA `Szukaj korepetytora`
- [ ] 3 punkty zaufania
- [ ] 3 kroki „Jak to działa”
- [ ] 3 karty polecanych z ceną, oceną i najbliższym terminem
- [ ] 3 korzyści
- [ ] sekcja CTA dla korepetytorów
- [ ] footer z linkami i legal
- [ ] brak filtra „tryb” (v1 = online)
- [ ] brak „lekcji próbnej” w copy
- [ ] copy dokładnie po polsku, bez lorem ipsum
- [ ] mobile 390 i 360 bez horizontal scrolla
- [ ] widoczne stany fokusu
- [ ] użyte tokeny kolorów, typografii i spacingu

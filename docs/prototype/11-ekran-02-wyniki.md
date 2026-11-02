# Ekran 02 — Wyniki + filtry

## Meta

| Pole | Wartość |
|---|---|
| ID | S2 |
| Frame mobile | `M/02-Wyniki` — 390×844 |
| Frame desktop | `D/02-Wyniki` — 1280×1024 |
| Dostęp | publiczny |
| Persona | Zosia, maturzystka |
| Cel | porównać korepetytorów i wejść w profil |
| Wejście | S1 — `Szukaj korepetytora` |
| Wyjście | S3 — profil; S1 — logo |
| Główne CTA | `Zobacz profil` na karcie |

## 1. Układ desktop

| # | Sekcja | Zawartość |
|---|---|---|
| 1 | Header | ten sam co S1; aktywny link `Korepetytorzy` |
| 2 | Page header | breadcrumb, H1, subhead z liczbą profili |
| 3 | Filter bar | 4 selecty: poziom, dział, cena, ocena + `Wyczyść` |
| 4 | Active chips | aktywne filtry z `×` |
| 5 | Results header | `Znaleziono 8 korepetytorów` + sort |
| 6 | Grid | 3 kolumny × 2 rzędy kart |
| 7 | Pagination | `Pokaż więcej` lub numery stron |
| 8 | Trust note | `Opinie tylko po zakończonej lekcji.` |
| 9 | Footer | jak w S1 |

Sekcje 2–8 w kontenerze 1200 px, padding pionowy 48–64 px.

## 2. Układ mobile

1. Header: logo + `Zaloguj się` + hamburger.
2. H1 + subhead.
3. Przycisk `Filtry (3)` + sortowanie.
4. Aktywne chipy — poziomy scroll.
5. Licznik wyników.
6. Karty korepetytorów — 1 kolumna.
7. `Pokaż więcej`.
8. Footer.

Filtry na mobile: **bottom sheet** z 4 selectami, `Zastosuj filtry` i `Wyczyść`.

## 3. Wireframe — desktop

```text
┌──────────────────────────────────────────────────────────────┐
│ MaturaKorki  Jak to działa  Korepetytorzy  Dla korep.  Zaloguj│
├──────────────────────────────────────────────────────────────┤
│ Strona główna / Korepetytorzy                                │
│ Korepetytorzy z matematyki do matury                         │
│ 8 profili · online · podstawa i rozszerzenie                 │
│                                                              │
│ [Poziom v] [Dział v] [Cena v] [Ocena v]        [Wyczyść]     │
│ [Rozszerzenie ×] [Geometria analityczna ×] [do 120 zł ×]     │
│                                                              │
│ Znaleziono 8 korepetytorów                 [Sortuj: termin v]│
│ ┌────────────┐ ┌────────────┐ ┌────────────┐                 │
│ │ TutorCard  │ │ TutorCard  │ │ TutorCard  │                 │
│ └────────────┘ └────────────┘ └────────────┘                 │
│ ┌────────────┐ ┌────────────┐ ┌────────────┐                 │
│ │ TutorCard  │ │ TutorCard  │ │ TutorCard  │                 │
│ └────────────┘ └────────────┘ └────────────┘                 │
│                      [Pokaż więcej]                          │
│ Opinie tylko po zakończonej lekcji.                          │
├──────────────────────────────────────────────────────────────┤
│ footer                                                       │
└──────────────────────────────────────────────────────────────┘
```

## 4. Wireframe — mobile

```text
┌───────────────────────────────┐
│ MaturaKorki      Zaloguj  ☰  │
├───────────────────────────────┤
│ Strona główna / Korepetytorzy │
│ Korepetytorzy z matematyki    │
│ do matury                     │
│ 8 profili · online            │
│                               │
│ [ Filtry (3) ] [Sortuj v]     │
│ [Rozszerzenie ×] [Geometria ×]│
│                               │
│ Znaleziono 8 korepetytorów    │
│ ┌───────────────────────────┐ │
│ │ TutorCard                 │ │
│ └───────────────────────────┘ │
│ ┌───────────────────────────┐ │
│ │ TutorCard                 │ │
│ └───────────────────────────┘ │
│ ┌───────────────────────────┐ │
│ │ TutorCard                 │ │
│ └───────────────────────────┘ │
│ [ Pokaż więcej ]              │
├───────────────────────────────┤
│ footer                        │
└───────────────────────────────┘
```

## 5. Komponenty

`Navbar`, `Breadcrumb`, `Select`, `FilterChip`, `TutorCard`, `Badge`, `Rating`, `Button`, `Pagination`, `EmptyState`, `Skeleton`, `Footer`.

## 6. Copy PL

### Page header

- Breadcrumb: `Strona główna / Korepetytorzy`
- H1: `Korepetytorzy z matematyki do matury`
- Subhead: `8 profili · online · podstawa i rozszerzenie`

### Filtry

- `Poziom` — `Dowolny poziom`, `Podstawa`, `Rozszerzenie`
- `Dział` — `Dowolny dział`, `Funkcje`, `Równania i nierówności`, `Wyrażenia algebraiczne`, `Ciągi`, `Trygonometria`, `Planimetria`, `Geometria analityczna`, `Stereometria`, `Prawdopodobieństwo i statystyka`, `Kombinatoryka`
- `Cena za godzinę` — `Dowolna`, `do 80 zł`, `80–120 zł`, `120–160 zł`, `160+ zł`
- `Ocena` — `Dowolna`, `4.0+`, `4.5+`
- `Wyczyść`
- Sort: `Najbliższy termin`, `Najniższa cena`, `Najwyższa ocena`

### Aktywne chipy

- `Rozszerzenie ×`
- `Geometria analityczna ×`
- `do 120 zł ×`
- `4.5+ ×`

### Wyniki

- `Znaleziono 8 korepetytorów`
- `Pokaż więcej`
- `Opinie tylko po zakończonej lekcji.`

### Karty

1. `Michał K.` · `Rozszerzenie` · `Geometria analityczna, Funkcje` · `110 zł/h` · `4.9 (23 opinie)` · `Najbliższy termin: czw. 18:00` · `Zobacz profil`
2. `Anna W.` · `Podstawa i rozszerzenie` · `Prawdopodobieństwo, Ciągi` · `95 zł/h` · `4.8 (17 opinii)` · `Najbliższy termin: dziś 19:00` · `Zobacz profil`
3. `Tomasz R.` · `Rozszerzenie` · `Trygonometria, Stereometria` · `130 zł/h` · `5.0 (11 opinii)` · `Najbliższy termin: pt. 16:30` · `Zobacz profil`
4. `Karolina S.` · `Podstawa` · `Równania i nierówności, Planimetria` · `85 zł/h` · `4.7 (31 opinii)` · `Najbliższy termin: wt. 17:00` · `Zobacz profil`
5. `Paweł M.` · `Rozszerzenie` · `Kombinatoryka, Prawdopodobieństwo` · `120 zł/h` · `4.6 (14 opinii)` · `Najbliższy termin: sob. 10:00` · `Zobacz profil`
6. `Julia D.` · `Podstawa i rozszerzenie` · `Funkcje, Ciągi` · `100 zł/h` · `4.9 (28 opinii)` · `Najbliższy termin: pon. 18:30` · `Zobacz profil`

### Pusty stan

- `Brak korepetytorów dla tych filtrów`
- `Spróbuj usunąć jeden z filtrów albo zmienić dział.`
- `Wyczyść filtry`

### Loading

- `Ładowanie korepetytorów…`

## 7. Stany

| Stan | Zachowanie |
|---|---|
| Domyślny | 8 wyników, 6 kart widocznych |
| Filtry aktywne | chipy + licznik wyników |
| Brak wyników | EmptyState + `Wyczyść filtry` |
| Ładowanie | 6 skeletonów kart |
| Mobile filtry | bottom sheet z 4 selectami |
| Sortowanie | zmiana kolejności kart |

## 8. Responsywność

- Desktop ≥ 1024: 3 kolumny.
- Tablet 768–1023: 2 kolumny.
- Mobile < 768: 1 kolumna, filtry w bottom sheet.
- Brak horizontal scrolla przy 360 px.

## 9. Dostępność

- Filtry mają widoczne labelki.
- Chipy usuwalne mają `aria-label` („Usuń filtr Rozszerzenie”).
- Licznik wyników w `aria-live="polite"`.
- Karty: całość klikalna, ale `Zobacz profil` to prawdziwy link.
- Focus ring `color/focus`, target 44 px.

## 10. Prompt do Stitcha

Prefiks: globalny styl z `10-ekran-01-landing.md` §10.

```text
Design a desktop results page (1280x1024) for MaturaKorki, same visual system as the landing page: paper #FBF8F3, cards #FFFFFF, ink #14213D, primary #1F5F5B, accent #E8A33D, Source Serif 4 headings, Inter UI, 12-column grid, max width 1200px, 8px card radius, no gradients.

Sections:
1. Same public header as the landing page; "Korepetytorzy" is active.
2. Breadcrumb "Strona główna / Korepetytorzy"; H1 "Korepetytorzy z matematyki do matury"; subhead "8 profili · online · podstawa i rozszerzenie".
3. Filter bar with four selects: "Poziom — Dowolny poziom", "Dział — Dowolny dział", "Cena za godzinę — Dowolna", "Ocena — Dowolna", plus ghost "Wyczyść".
4. Active filter chips: "Rozszerzenie ×", "Geometria analityczna ×", "do 120 zł ×", "4.5+ ×".
5. Results header: "Znaleziono 8 korepetytorów" and a sort dropdown "Najbliższy termin".
6. Grid of 6 tutor cards in 3 columns. Each card: avatar initials, name, verified check, level badge, two topic chips, rating (e.g. "4.9 (23 opinie)"), price "110 zł/h", "Najbliższy termin: czw. 18:00", ghost link "Zobacz profil".
   Cards: Michał K. / Rozszerzenie / Geometria analityczna, Funkcje / 110 zł/h / 4.9 (23 opinie) / czw. 18:00; Anna W. / Podstawa i rozszerzenie / Prawdopodobieństwo, Ciągi / 95 zł/h / 4.8 (17 opinii) / dziś 19:00; Tomasz R. / Rozszerzenie / Trygonometria, Stereometria / 130 zł/h / 5.0 (11 opinii) / pt. 16:30; Karolina S. / Podstawa / Równania i nierówności, Planimetria / 85 zł/h / 4.7 (31 opinii) / wt. 17:00; Paweł M. / Rozszerzenie / Kombinatoryka, Prawdopodobieństwo / 120 zł/h / 4.6 (14 opinii) / sob. 10:00; Julia D. / Podstawa i rozszerzenie / Funkcje, Ciągi / 100 zł/h / 4.9 (28 opinii) / pon. 18:30.
7. "Pokaż więcej" button centered; note "Opinie tylko po zakończonej lekcji."
8. Same footer as the landing page.

Use the exact Polish copy. Do not add filters for mode or trial lessons.
```

Mobile prompt:

```text
Adapt the MaturaKorki results page to 390x844: same header, H1, subhead, a "Filtry (3)" button and sort control, horizontally scrollable filter chips, result count, 6 stacked tutor cards, "Pokaż więcej", footer. Filters open as a bottom sheet with four selects and "Zastosuj filtry" / "Wyczyść". No horizontal scroll at 360px.
```

## 11. Checklista akceptacji

- [ ] H1 i filtry widoczne bez scrolla na desktopie
- [ ] 4 filtry: poziom, dział, cena, ocena
- [ ] aktywne chipy z `×` i `Wyczyść`
- [ ] licznik wyników + sort
- [ ] 6 kart w 3 kolumnach (desktop) / 1 kolumnie (mobile)
- [ ] mobile: bottom sheet filtrów
- [ ] empty state + skeleton
- [ ] brak filtra trybu i lekcji próbnej
- [ ] copy dokładnie po polsku
- [ ] 360 px bez horizontal scrolla

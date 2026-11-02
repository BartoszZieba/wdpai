# Ekran 03 — Profil korepetytora

## Meta

| Pole | Wartość |
|---|---|
| ID | S3 |
| Frame mobile | `M/03-Profil` — 390×844 |
| Frame desktop | `D/03-Profil` — 1280×1024 |
| Dostęp | publiczny |
| Persona | Zosia |
| Cel | ocenić korepetytora i przejść do rezerwacji |
| Wejście | S2 — `Zobacz profil` |
| Wyjście | S4 — `Zarezerwuj termin`; S2 — breadcrumb |
| Główne CTA | `Zarezerwuj termin` |

## 1. Układ desktop

| # | Sekcja | Zawartość |
|---|---|---|
| 1 | Header | publiczny, jak S1 |
| 2 | Breadcrumb | `Korepetytorzy / Michał K.` |
| 3 | Profile header | avatar 96, imię, verified, ocena, badge poziomu, tematy, cena, CTA |
| 4 | Statystyki | 120 lekcji · 4.9 · 23 opinie · 5 lat |
| 5 | Lewa kolumna (8/12) | `O korepetytorze`, `Wykształcenie`, `Działy`, `Opinie` |
| 6 | Prawa kolumna (4/12) | sticky karta rezerwacji z 3 terminami i CTA |
| 7 | Opinie | 3 ReviewCard + `Zobacz wszystkie opinie` |
| 8 | Footer | jak S1 |

## 2. Układ mobile

1. Header: logo + `Zaloguj się` + hamburger.
2. Breadcrumb (back arrow + `Michał K.`).
3. Profile header: avatar 72, imię, verified, ocena, badge, cena.
4. Sticky bottom CTA: `Zarezerwuj termin · 110 zł`.
5. `O korepetytorze`.
6. `Wykształcenie`.
7. `Działy` — chips.
8. `Najbliższe terminy` — 3 sloty + CTA.
9. `Opinie` — 3 karty.
10. Footer.

## 3. Wireframe — desktop

```text
┌──────────────────────────────────────────────────────────────┐
│ MaturaKorki  Jak to działa  Korepetytorzy  Dla korep.  Zaloguj│
├──────────────────────────────────────────────────────────────┤
│ Korepetytorzy / Michał K.                                    │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ (MK)  Michał K. ✓  4.9 (23 opinie)                       │ │
│ │       Rozszerzenie · Geometria analityczna, Funkcje      │ │
│ │       110 zł/h · online              [Zarezerwuj termin] │ │
│ └──────────────────────────────────────────────────────────┘ │
│ 120 lekcji    4.9    23 opinie    5 lat                      │
│                                                              │
│ ┌──────────────────────────────┐  ┌───────────────────────┐ │
│ │ O korepetytorze              │  │ Najbliższe terminy    │ │
│ │ ...                          │  │ [czw. 18:00]          │ │
│ │ Wykształcenie                │  │ [pt. 16:30]           │ │
│ │ ...                          │  │ [sob. 10:00]          │ │
│ │ Działy                       │  │ [Zarezerwuj termin]   │ │
│ │ [Geometria] [Funkcje]        │  │ 60 min · online       │ │
│ │                              │  │ Płatność po lekcji    │ │
│ │ Opinie                       │  └───────────────────────┘ │
│ │ [ReviewCard]                 │                            │
│ │ [ReviewCard]                 │                            │
│ │ [ReviewCard]                 │                            │
│ │ Zobacz wszystkie opinie →    │                            │
│ └──────────────────────────────┘                            │
├──────────────────────────────────────────────────────────────┤
│ footer                                                       │
└──────────────────────────────────────────────────────────────┘
```

## 4. Wireframe — mobile

```text
┌───────────────────────────────┐
│ MaturaKorki      Zaloguj  ☰  │
├───────────────────────────────┤
│ ← Korepetytorzy / Michał K.  │
│ (MK) Michał K. ✓              │
│ 4.9 (23 opinie)               │
│ Rozszerzenie                  │
│ 110 zł/h · online             │
│                               │
│ O korepetytorze               │
│ ...                           │
│ Wykształcenie                 │
│ ...                           │
│ Działy                        │
│ [Geometria] [Funkcje]         │
│ Najbliższe terminy            │
│ [czw. 18:00] [pt. 16:30]      │
│ [sob. 10:00]                  │
│ Opinie                        │
│ [ReviewCard]                  │
│ [ReviewCard]                  │
│ [ReviewCard]                  │
│                               │
│ █ Zarezerwuj termin · 110 zł █│
└───────────────────────────────┘
```

## 5. Komponenty

`Navbar`, `Breadcrumb`, `Avatar`, `Badge`, `Rating`, `Button`, `ReviewCard`, `SlotPicker` (compact), `Footer`, `EmptyState`.

## 6. Copy PL

### Profil

- `Michał K.` · `Profil zatwierdzony`
- `Korepetytor matematyki`
- `Rozszerzenie`
- `4.9 (23 opinie)`
- `110 zł/h`
- `Online`
- `Zarezerwuj termin`
- Statystyki: `120 lekcji` · `4.9` · `23 opinie` · `5 lat doświadczenia`

### O korepetytorze

`Uczę matematyki od 5 lat. Pomagam maturzystom ogarnąć działy, które sprawiają najwięcej problemów — od funkcji po geometrię analityczną. Na zajęciach rozwiązujemy zadania maturalne i pracujemy nad strategią egzaminu.`

### Wykształcenie

`Studia matematyczne · 5 lat doświadczenia w nauczaniu.`

### Działy

`Geometria analityczna` · `Funkcje` · `Trygonometria`

### Karta rezerwacji

- `Najbliższe terminy`
- `czw. 18:00` · `pt. 16:30` · `sob. 10:00`
- `Zarezerwuj termin`
- `Lekcja 60 min · online`
- `Płatność po lekcji`
- `Bez opłat online.`

### Opinie

- `Opinie` · `4.9` · `23 opinie`
- `Zosia` · `5.0` · `2 tygodnie temu` — `Dzięki Michałowi ogarnęłam wektory przed maturą. Konkretnie, bez lania wody.`
- `Kuba` · `5.0` · `miesiąc temu` — `Świetne tłumaczenie zadań z funkcji. Dużo przykładów maturalnych.`
- `Ola` · `4.0` · `2 miesiące temu` — `Solidne zajęcia, ale warto wcześniej wysłać temat.`
- `Zobacz wszystkie opinie →`

### Mobile CTA

`Zarezerwuj termin · 110 zł`

## 7. Stany

| Stan | Zachowanie |
|---|---|
| Domyślny | profil + 3 opinie + 3 terminy |
| Brak opinii | EmptyState `Opinie pojawią się po zakończonej lekcji` |
| Brak terminów | `Brak wolnych terminów — sprawdź później` |
| Niezalogowany | CTA prowadzi do logowania w S4 |
| Profil nieaktywny | widok niedostępny — 404 (poza prototypem) |

## 8. Responsywność

- Desktop: 8/4 kolumny, sticky karta rezerwacji.
- Tablet: 1 kolumna, karta rezerwacji pod opisem.
- Mobile: 1 kolumna, sticky bottom CTA, opinie na końcu.
- Brak horizontal scrolla przy 360 px.

## 9. Dostępność

- Avatar ma alt z imieniem.
- Gwiazdki mają tekstową ocenę obok.
- Sticky CTA nie zasłania treści — padding-bottom 96 px.
- Sloty jako przyciski z `aria-pressed`.
- Focus ring i target 44 px.

## 10. Prompt do Stitcha

Prefiks: globalny styl z `10-ekran-01-landing.md` §10.

```text
Design a desktop tutor profile page (1280x1024) for MaturaKorki, same visual system as the landing page: paper #FBF8F3, surface #FFFFFF, ink #14213D, primary #1F5F5B, accent #E8A33D, Source Serif 4 headings, Inter UI, 12-column grid, max width 1200px, 8px radius, no gradients.

Sections:
1. Same public header as the landing page.
2. Breadcrumb "Korepetytorzy / Michał K.".
3. Profile header card: circular avatar initials "MK", name "Michał K." with verified badge, subtitle "Korepetytor matematyki", rating "4.9 (23 opinie)", level badge "Rozszerzenie", topic chips "Geometria analityczna", "Funkcje", "Trygonometria", price "110 zł/h", "Online", primary button "Zarezerwuj termin".
4. Stats row: "120 lekcji · 4.9 · 23 opinie · 5 lat doświadczenia".
5. Two columns (8/4). Left: "O korepetytorze" with the bio "Uczę matematyki od 5 lat. Pomagam maturzystom ogarnąć działy, które sprawiają najwięcej problemów — od funkcji po geometrię analityczną. Na zajęciach rozwiązujemy zadania maturalne i pracujemy nad strategią egzaminu."; "Wykształcenie" with "Studia matematyczne · 5 lat doświadczenia w nauczaniu."; "Działy" chips; "Opinie" with three review cards: Zosia 5.0 "Dzięki Michałowi ogarnęłam wektory przed maturą. Konkretnie, bez lania wody.", Kuba 5.0 "Świetne tłumaczenie zadań z funkcji. Dużo przykładów maturalnych.", Ola 4.0 "Solidne zajęcia, ale warto wcześniej wysłać temat."; link "Zobacz wszystkie opinie →".
   Right: sticky booking card "Najbliższe terminy" with three slot buttons "czw. 18:00", "pt. 16:30", "sob. 10:00", primary button "Zarezerwuj termin", small text "Lekcja 60 min · online", "Płatność po lekcji" and "Bez opłat online."
6. Same footer as the landing page.

Use exact Polish copy. No prices other than 110 zł/h. No trial lesson.
```

Mobile prompt:

```text
Adapt the profile to 390x844: back breadcrumb, compact profile header with avatar and price, stacked "O korepetytorze", "Wykształcenie", "Działy", "Najbliższe terminy" and "Opinie", plus a sticky bottom CTA "Zarezerwuj termin · 110 zł". Keep 96px bottom padding so the CTA does not cover the footer.
```

## 11. Checklista akceptacji

- [ ] profil z avatarem, oceną, poziomem i ceną
- [ ] 3 działy jako chipy
- [ ] 3 statystyki
- [ ] sticky karta rezerwacji z 3 terminami (desktop)
- [ ] sticky bottom CTA (mobile)
- [ ] 3 opinie + link „Zobacz wszystkie”
- [ ] brak wymyślonych certyfikatów/uczelni
- [ ] copy dokładnie po polsku
- [ ] 360 px bez horizontal scrolla

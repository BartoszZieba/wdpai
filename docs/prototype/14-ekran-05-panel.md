# Ekran 05 — Panel ucznia

## Meta

| Pole | Wartość |
|---|---|
| ID | S5 |
| Frame mobile | `M/05-Panel` — 390×844 |
| Frame desktop | `D/05-Panel` — 1280×1024 |
| Dostęp | uczeń (zalogowany) |
| Persona | Zosia |
| Cel | zarządzać lekcjami i wystawić opinię |
| Wejście | S4 — `Przejdź do moich lekcji`; header — `Moje lekcje` |
| Wyjście | S3 — `Znajdź korepetytora`; S2 — `Szukaj` |
| Główne CTA | `Anuluj` / `Wystaw opinię` |

## 1. Układ desktop

| # | Sekcja | Zawartość |
|---|---|---|
| 1 | App header | logo, `Szukaj`, `Moje lekcje` (active), avatar `Z` |
| 2 | Page header | H1 `Moje lekcje`, subhead, opcjonalnie `Znajdź korepetytora` |
| 3 | Tabs | `Najbliższe` · `Historia` · `Opinie` |
| 4 | Lista lekcji | 4 LessonCard: pending, accepted, completed, cancelled |
| 5 | Empty state | gdy brak lekcji w zakładce |
| 6 | Modal opinii | po `Wystaw opinię` |
| 7 | Minimal footer | `Pomoc` · `Regulamin` · `Polityka prywatności` |

Lista w kontenerze 900 px, karty pełnej szerokości.

## 2. Układ mobile

1. App header: logo + avatar, hamburger.
2. H1 + subhead.
3. Tabs poziomo (scroll).
4. Karty lekcji jedna pod drugą.
5. Empty state.
6. Modal opinii jako bottom sheet.
7. Brak stopki lub minimalna.

## 3. Wireframe — desktop

```text
┌──────────────────────────────────────────────────────────────┐
│ MaturaKorki      Szukaj      Moje lekcje          (Z) avatar │
├──────────────────────────────────────────────────────────────┤
│ Moje lekcje                                                  │
│ Zarządzaj rezerwacjami i opiniami.       [Znajdź korepetytora]│
│                                                              │
│ Najbliższe     Historia     Opinie                           │
│ ───────────                                                  │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ czw. 29.10 · 18:00   Michał K.   Geometria analityczna   │ │
│ │ 110 zł   [Oczekuje na akceptację]              [Anuluj]  │ │
│ └──────────────────────────────────────────────────────────┘ │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ pt. 30.10 · 19:00    Anna W.     Prawdopodobieństwo      │ │
│ │ 95 zł    [Zaakceptowana]                       [Anuluj]  │ │
│ └──────────────────────────────────────────────────────────┘ │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ wt. 20.10 · 17:00    Tomasz R.   Trygonometria           │ │
│ │ 130 zł   [Zakończona]                    [Wystaw opinię] │ │
│ └──────────────────────────────────────────────────────────┘ │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ czw. 15.10 · 18:00   Karolina S. Planimetria             │ │
│ │ 85 zł    [Anulowana]                                     │ │
│ └──────────────────────────────────────────────────────────┘ │
├──────────────────────────────────────────────────────────────┤
│ Pomoc · Regulamin · Polityka prywatności                     │
└──────────────────────────────────────────────────────────────┘
```

## 4. Wireframe — mobile

```text
┌───────────────────────────────┐
│ MaturaKorki        (Z)   ☰   │
├───────────────────────────────┤
│ Moje lekcje                   │
│ Zarządzaj rezerwacjami...     │
│                               │
│ Najbliższe  Historia  Opinie  │
│ ───────────                   │
│ ┌───────────────────────────┐ │
│ │ czw. 29.10 · 18:00        │ │
│ │ Michał K.                 │ │
│ │ Geometria analityczna     │ │
│ │ 110 zł  [Oczekuje]        │ │
│ │ [Anuluj]                  │ │
│ └───────────────────────────┘ │
│ ┌───────────────────────────┐ │
│ │ pt. 30.10 · 19:00        │ │
│ │ Anna W.                   │ │
│ │ Prawdopodobieństwo        │ │
│ │ 95 zł   [Zaakceptowana]   │ │
│ │ [Anuluj]                  │ │
│ └───────────────────────────┘ │
└───────────────────────────────┘
```

## 5. Komponenty

`AppNavbar`, `Tabs`, `LessonCard`, `Badge`, `Button`, `Avatar`, `EmptyState`, `Modal` / `BottomSheet` (opinia), `Rating` (input), `Textarea`.

## 6. Copy PL

### Header

- `Szukaj` · `Moje lekcje` · avatar `Z`
- Menu: `Profil` · `Wyloguj`

### Page header

- H1: `Moje lekcje`
- Subhead: `Zarządzaj rezerwacjami i opiniami.`
- `Znajdź korepetytora`

### Tabs

`Najbliższe` · `Historia` · `Opinie`

### Karty lekcji

1. `czw. 29.10 · 18:00` — `Michał K.` — `Geometria analityczna` — `110 zł` — `Oczekuje na akceptację` — `Anuluj`
2. `pt. 30.10 · 19:00` — `Anna W.` — `Prawdopodobieństwo` — `95 zł` — `Zaakceptowana` — `Anuluj`
3. `wt. 20.10 · 17:00` — `Tomasz R.` — `Trygonometria` — `130 zł` — `Zakończona` — `Wystaw opinię`
4. `czw. 15.10 · 18:00` — `Karolina S.` — `Planimetria` — `85 zł` — `Anulowana`

### Empty states

- `Nie masz jeszcze lekcji` / `Znajdź korepetytora i zarezerwuj pierwszy termin.` / `Znajdź korepetytora`
- `Brak historii lekcji`
- `Nie wystawiłeś jeszcze opinii`

### Modal opinii

- `Wystaw opinię`
- `Jak oceniasz lekcję?`
- Gwiazdki 1–5
- `Opinia (opcjonalnie)`
- Placeholder: `Napisz, co było pomocne.`
- `Wyślij opinię`
- `Anuluj`
- Po wysłaniu: `Dziękujemy za opinię.`

### Statusy

| Status | Badge |
|---|---|
| `pending` | `Oczekuje na akceptację` |
| `accepted` | `Zaakceptowana` |
| `completed` | `Zakończona` |
| `cancelled` | `Anulowana` |
| `declined` | `Odrzucona` |

## 7. Stany

| Stan | Zachowanie |
|---|---|
| Najbliższe | 2 lekcje: pending + accepted |
| Historia | completed + cancelled |
| Opinie | puste lub lista wystawionych opinii |
| Brak lekcji | EmptyState + CTA |
| Anulowanie | modal potwierdzenia `Anulować lekcję?` |
| Opinia | modal/bottom sheet, 1–5 + komentarz |
| Po opinii | toast `Dziękujemy za opinię.` |

## 8. Responsywność

- Desktop: lista 900 px, karty wierszowe.
- Tablet: lista 100%.
- Mobile: karty stacked, akcje pełna szerokość.
- Tabs przewijane poziomo na 360 px.

## 9. Dostępność

- Tabs z `role="tablist"` / `aria-selected`.
- Statusy tekstowe, nie tylko kolory.
- Modal: focus trap, Escape.
- Gwiazdki jako radio group z opisem.
- Target 44 px.

## 10. Prompt do Stitcha

Prefiks: globalny styl z `10-ekran-01-landing.md` §10.

```text
Design a desktop student dashboard (1280x1024) for MaturaKorki, same visual system as the landing page: paper #FBF8F3, surface #FFFFFF, ink #14213D, primary #1F5F5B, accent #E8A33D, Source Serif 4 headings, Inter UI, 12-column grid, max width 1200px, 8px radius, no gradients.

Sections:
1. App header: wordmark "MaturaKorki", links "Szukaj" and "Moje lekcje" (active), circular avatar "Z".
2. Page header: H1 "Moje lekcje", subhead "Zarządzaj rezerwacjami i opiniami.", secondary button "Znajdź korepetytora".
3. Tabs: "Najbliższe" active, "Historia", "Opinie".
4. Lesson list (max width 900px), four full-width cards:
   - "czw. 29.10 · 18:00" / "Michał K." / "Geometria analityczna" / "110 zł" / warning badge "Oczekuje na akceptację" / ghost "Anuluj"
   - "pt. 30.10 · 19:00" / "Anna W." / "Prawdopodobieństwo" / "95 zł" / success badge "Zaakceptowana" / ghost "Anuluj"
   - "wt. 20.10 · 17:00" / "Tomasz R." / "Trygonometria" / "130 zł" / neutral badge "Zakończona" / primary link "Wystaw opinię"
   - "czw. 15.10 · 18:00" / "Karolina S." / "Planimetria" / "85 zł" / muted badge "Anulowana"
5. Minimal footer: "Pomoc", "Regulamin", "Polityka prywatności".

Use exact Polish copy. Statuses are text + color, never color alone. No chat, no payments.
```

Mobile prompt:

```text
Adapt the student dashboard to 390x844: compact app header with avatar and hamburger, H1 and subhead, horizontally scrollable tabs, four stacked lesson cards with full-width actions, and the same status badges. Keep 44px touch targets and no horizontal scroll at 360px.
```

## 11. Checklista akceptacji

- [ ] app header z `Moje lekcje` aktywnym
- [ ] 3 zakładki
- [ ] 4 karty z różnymi statusami
- [ ] `Anuluj` przy pending/accepted
- [ ] `Wystaw opinię` przy completed
- [ ] empty state dla braku lekcji
- [ ] modal opinii z gwiazdkami i komentarzem
- [ ] statusy tekstowe + kolory
- [ ] brak czatu i płatności
- [ ] mobile bez horizontal scrolla

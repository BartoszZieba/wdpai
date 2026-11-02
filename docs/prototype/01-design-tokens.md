# Tokeny designu — MaturaKorki

Wspólne źródło prawdy dla Figma Variables i późniejszego CSS (Lab 3).
Nazwy tokenów są celowo takie same w Figmie i w CSS.

> **Źródło:** finalny eksport Figma z 2026-11-02 (`figma_export/`).
> PNG są ważniejsze niż automatyczny `DESIGN.md`; ten plik opisuje tokeny, które mamy wdrożyć.
> Desktop: **1280 px**, mobile: **390 px**.

## 1. Kierunek wizualny

**Warm academic / „papier i atrament”.** Zaufanie, skupienie, czytelność — nie kolejny fioletowy SaaS.

- tło: ciepła kość słoniowa,
- tekst: głęboki granat,
- akcent główny: ciemny morski/teal,
- akcent pomocniczy: ciepły amber (tylko z ciemnym tekstem),
- typografia: serif w nagłówkach + czytelny sans w UI,
- dużo światła, wyraźna hierarchia, jeden główny CTA na ekran,
- brak gradientów, 3D, „AI illustrations” i stockowych uścisków dłoni.

Motyw pomocniczy: subtelna **siatka jak w zeszycie do matematyki** (24×24 px) tylko w hero.

## 2. Kolory

| Token | HEX | Rola |
|---|---|---|
| `color/ink` | `#14213D` | tekst główny, ciemne tła, nagłówki |
| `color/ink-muted` | `#5C6675` | tekst pomocniczy, metadane |
| `color/forest` | `#003330` | logo, wybrane sloty/dni, ciemne akcenty |
| `color/terracotta` | `#A43D00` | badge poziomu (`Rozszerzenie`, `Podstawa`); tekst biały |
| `color/peach` | `#FFDBCD` | tło badge `pending`, delikatne ostrzeżenia |
| `color/teal-soft` | `#BEEBE6` | tło chipów opinii/ocen |
| `color/paper` | `#FBF8F3` | tło strony |
| `color/surface` | `#FFFFFF` | karty, inputy, modale |
| `color/surface-alt` | `#F3EEE6` | sekcje naprzemienne, hover wierszy |
| `color/primary` | `#1F5F5B` | główne CTA, linki, aktywne stany |
| `color/primary-hover` | `#174A47` | hover CTA |
| `color/primary-soft` | `#E3F0ED` | tła badge’y, zaznaczone filtry |
| `color/accent` | `#E8A33D` | gwiazdki ocen, górna krawędź `pending`, wyróżnienia |
| `color/accent-soft` | `#FBEBD2` | tło łagodnego akcentu (nie badge poziomu) |
| `color/border` | `#E4DED3` | obramowania kart i inputów |
| `color/border-strong` | `#CFC6B8` | hover/aktywny border |
| `color/success` | `#2E7D5B` | status `accepted`, komunikaty sukcesu |
| `color/success-soft` | `#E6F4EC` | tło sukcesu |
| `color/danger` | `#B42318` | błędy, `declined`, akcje destrukcyjne |
| `color/danger-soft` | `#FDECEA` | tło błędu |
| `color/warning` | `#B54708` | `pending`, ostrzeżenia |
| `color/warning-soft` | `#FFDBCD` | tło ostrzeżenia / `pending` |
| `color/focus` | `#0B63CE` | ring fokusu (zawsze widoczny) |
| `color/on-dark` | `#FFFFFF` | tekst i ikony na ciemnych oraz primary powierzchniach |
| `color/on-dark-muted` | `#D1D5DB` | pomocniczy tekst na ciemnym tle |
| `color/overlay` | `rgba(20, 33, 61, 0.48)` | tło modali i bottom sheetów |

**Zasady:**
- Na `primary` i `forest` tekst zawsze biały. Na `accent` **tylko** `ink` — nigdy biały.
- `terracotta` to badge poziomu, nie główne CTA; tekst na nim biały.
- `ink-muted` nie służy do długich akapitów, tylko do metadanych.
- Status zawsze ma tekst + kolor, nigdy sam kolor.
- Kolory statusów nie są używane dekoracyjnie.

## 3. Typografia

| Rola | Font | Waga |
|---|---|---|
| Display, H1, H2 | **Source Serif 4** | 600 |
| H3, UI, body, przyciski | **Inter** | 400 / 500 / 600 / 700 |

Fallback: `Source Serif 4, Georgia, serif` / `Inter, system-ui, -apple-system, sans-serif`.

> W finalnym eksporcie Figma nagłówki są szeryfowe; `DESIGN.md` z designmd.me zebrał tylko style body i nie jest źródłem prawdy dla typografii. Jeśli w Figmie jest inny serif niż Source Serif 4, zmieniamy **jeden** token `font/display`, nie mieszamy fontów.

| Token | Desktop | Mobile | Line-height | Uwagi |
|---|---|---|---|---|
| `type/display` | 60 px | 40 px | 1.07 | Source Serif 4 600, `-0.02em` |
| `type/h1` | 48 px | 32 px | 1.16 | Source Serif 4 600, `-0.02em` |
| `type/h2` | 36 px | 28 px | 1.22 | Source Serif 4 600, `-0.01em` |
| `type/h3` | 24 px | 20 px | 1.33 | Inter 600 |
| `type/body-lg` | 18 px | 18 px | 1.55 | Inter 400, max 52ch |
| `type/body` | 16 px | 16 px | 1.62 | Inter 400, max 65ch |
| `type/body-strong` | 16 px | 16 px | 1.62 | Inter 600 |
| `type/small` | 14 px | 14 px | 1.57 | Inter 400 |
| `type/caption` | 12 px | 12 px | 1.5 | Inter 500, `0.01em` |
| `type/button` | 16 px | 16 px | 1.5 | Inter 600 |
| `type/price` | 24 px | 20 px | 1.33 | Inter 700, `tabular-nums` |

## 4. Spacing

Skala 4 px: `4, 8, 12, 16, 24, 32, 48, 64, 96, 128`.

| Token | Wartość | Zastosowanie |
|---|---|---|
| `space/1` | 4 | mikro-odstępy, gap ikona–tekst |
| `space/2` | 8 | gap w badge, input–label |
| `space/3` | 12 | gap w przyciskach, małe karty |
| `space/4` | 16 | padding mobilny, gap kart |
| `space/6` | 24 | padding kart desktop, gap sekcji wewnątrz |
| `space/8` | 32 | odstęp między blokami |
| `space/12` | 48 | padding sekcji mobile |
| `space/16` | 64 | padding sekcji desktop (mały) |
| `space/24` | 96 | padding sekcji desktop |
| `space/32` | 128 | hero desktop |

Sekcje: mobile 48–64 px, desktop 96–128 px. Karty: 20–24 px.

## 5. Promienie

| Token | Wartość | Zastosowanie |
|---|---|---|
| `radius/sm` | 4 px | inputy, selecty, przyciski |
| `radius/md` | 8 px | karty, mniejsze panele |
| `radius/lg` | 12 px | duże karty, hero, panele |
| `radius/xl` | 16 px | modale, bottom sheety |
| `radius/pill` | 999 px | badge, filtry, avatary |

## 6. Cienie

| Token | Wartość |
|---|---|
| `shadow/sm` | `0 1px 2px rgba(20, 33, 61, 0.06)` |
| `shadow/md` | `0 8px 24px rgba(20, 33, 61, 0.08)` |
| `shadow/lg` | `0 16px 48px rgba(20, 33, 61, 0.12)` |
| `focus/ring` | `0 0 0 3px #0B63CE` + `2px` offset |

Cienie tylko dla kart podniesionych, dropdownów i modali. Nie dla tekstu.

## 7. Grid i breakpointy

| Zakres | Kolumny | Margines | Gutter | Szerokość treści |
|---|---|---|---|---|
| Mobile 390 | 4 | 16 | 16 | 100% |
| Tablet 768 | 8 | 24 | 20 | 100% |
| Desktop 1280 | 12 | auto | 24 | max 1200 |

Breakpointy: `360`, `480`, `768 (48rem)`, `1024 (64rem)`, `1280 (80rem)`.
Szerokości treści: `narrow 680`, `default 1200`, `wide 1360`.

## 8. Ikony i obraz

- **Lucide** (jedyny zestaw), 20 / 24 px, stroke `1.75`, kolor `currentColor`.
- Ikony dekoracyjne: `aria-hidden="true"`.
- Zdjęcia korepetytorów: kwadrat 1:1, min. 400×400, naturalne światło.
- Fallback avatara: inicjały na `primary-soft` lub `accent-soft`.
- Hero: **kompozycja UI** (karta korepetytora + chipy terminów) na siatce zeszytowej — bez stockowych zdjęć i 3D.
- Żadnych emoji w UI.

## 9. Motion

- hover: 150 ms `ease-out`,
- modal / bottom sheet: 200 ms `ease-out`,
- bez parallaxu, autoplay i animacji „wszystkiego”,
- respektować `prefers-reduced-motion`.

## 10. Dostępność

- kontrast AA: 4.5:1 dla tekstu, 3:1 dla dużych napisów i elementów UI,
- fokus zawsze widoczny (`:focus-visible`, ring 3 px),
- target dotykowy min. 44×44 px,
- labelki zawsze widoczne — placeholder nie zastępuje labelki,
- błąd: tekst + ikona + kolor,
- status: tekst + kolor,
- hierarchia H1 → H2 → H3,
- zoom 200% bez utraty treści.

## 11. Figma — konfiguracja

**Strony:** `00 Cover`, `01 Foundations`, `02 Components`, `10 Mobile`, `20 Desktop`, `30 Prototype`.

**Kolekcje zmiennych:** `color`, `space`, `radius`, `type`.
**Nazwy:** `color/ink`, `space/4`, `radius/card`, `type/h1`.
**Tekst style:** `Display/60`, `H1/48`, `H2/36`, `H3/24`, `Body/16`, `Small/14`, `Caption/12`, `Button/16`, `Price/24`.

**Frame’y:** `M/01-Landing` (390×844), `D/01-Landing` (1280×1024).
Wszystko na auto layout; min./max. szerokości; komponenty z wariantami; prototyp połączony przepływami.

## 12. Mapowanie na CSS (później)

```css
:root {
  --font-display: 'Source Serif 4', Georgia, serif;
  --font-body: Inter, system-ui, -apple-system, sans-serif;
  --color-ink: #14213d;
  --color-ink-muted: #5c6675;
  --color-forest: #003330;
  --color-terracotta: #a43d00;
  --color-peach: #ffdbcd;
  --color-teal-soft: #beebe6;
  --color-paper: #fbf8f3;
  --color-surface: #ffffff;
  --color-surface-alt: #f3eee6;
  --color-primary: #1f5f5b;
  --color-primary-hover: #174a47;
  --color-primary-soft: #e3f0ed;
  --color-accent: #e8a33d;
  --color-accent-soft: #fbebd2;
  --color-border: #e4ded3;
  --color-border-strong: #cfc6b8;
  --color-success: #2e7d5b;
  --color-success-soft: #e6f4ec;
  --color-danger: #b42318;
  --color-danger-soft: #fdecea;
  --color-warning: #b54708;
  --color-warning-soft: #ffdbcd;
  --color-focus: #0b63ce;
  --color-on-dark: #ffffff;
  --color-on-dark-muted: #d1d5db;
  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 12px;
  --radius-xl: 16px;
  --space-1: 0.25rem;
  --space-2: 0.5rem;
  --space-3: 0.75rem;
  --space-4: 1rem;
  --space-6: 1.5rem;
  --space-8: 2rem;
  --space-12: 3rem;
  --space-16: 4rem;
  --space-24: 6rem;
  --space-32: 8rem;
}
```

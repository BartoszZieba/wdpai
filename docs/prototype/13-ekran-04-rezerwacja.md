# Ekran 04 — Rezerwacja + logowanie + potwierdzenie

## Meta

| Pole | Wartość |
|---|---|
| ID | S4 |
| Frame mobile | `M/04-Rezerwacja` — 390×844 |
| Frame desktop | `D/04-Rezerwacja` — 1280×1024 |
| Dostęp | uczeń (gość zostanie poproszony o logowanie) |
| Persona | Zosia |
| Cel | wybrać termin i wysłać zgłoszenie |
| Wejście | S3 — `Zarezerwuj termin` |
| Wyjście | S5 — `Przejdź do moich lekcji`; S3 — `Wróć do profilu` |
| Główne CTA | `Wyślij zgłoszenie` |

Do PDF liczą się **2 frame’y** S4: desktop + mobile. Logowanie i potwierdzenie to **stany/overlaye** w prototypie, nie osobne ekrany 10-ekranowego PDF.

## 1. Układ desktop

| # | Sekcja | Zawartość |
|---|---|---|
| 1 | Minimal header | logo + `Wróć do profilu` |
| 2 | Stepper | `1 Termin` → `2 Dane` → `3 Potwierdzenie` |
| 3 | Tutor summary | avatar, imię, poziom, dział, cena, 60 min |
| 4 | Lewa kolumna (7/12) | `Wybierz termin`, SlotPicker, `Twoja notatka` |
| 5 | Prawa kolumna (5/12) | sticky `Podsumowanie`, cena, CTA |
| 6 | Info | `Płatność po lekcji — bez opłat online.` |

W prototypie kroki 1–2 są na jednym scrollu (slot + notatka + podsumowanie), a krok 3 to overlay potwierdzenia — nie mnożymy frame’ów.

## 2. Układ mobile

1. Minimal header.
2. Stepper kompaktowy: `Krok 1 z 3 · Termin`.
3. Tutor summary — kompaktowy.
4. `Wybierz termin` — dni poziomo, godziny w siatce 3 kolumn.
5. `Twoja notatka (opcjonalnie)`.
6. `Podsumowanie` + cena.
7. Sticky CTA `Wyślij zgłoszenie`.

## 3. Wireframe — desktop

```text
┌──────────────────────────────────────────────────────────────┐
│ MaturaKorki                                  Wróć do profilu │
├──────────────────────────────────────────────────────────────┤
│ ① Termin ──── ② Dane ──── ③ Potwierdzenie                    │
│                                                              │
│ ┌──────────────────────────────────────────────────────────┐ │
│ │ (MK) Michał K. ✓   Rozszerzenie · Geometria analityczna  │ │
│ │ 110 zł/h · 60 min · online                               │ │
│ └──────────────────────────────────────────────────────────┘ │
│                                                              │
│ ┌──────────────────────────────┐  ┌───────────────────────┐ │
│ │ Wybierz termin               │  │ Podsumowanie          │ │
│ │ [czw. 29.10][pt. 30.10]...   │  │ Lekcja 60 min         │ │
│ │ [16:00][17:00][18:00][19:00] │  │ 110 zł                │ │
│ │                              │  │ Płatność po lekcji    │ │
│ │ Twoja notatka (opcjonalnie)  │  │ Bez opłat online.     │ │
│ │ ┌──────────────────────────┐ │  │ [Wyślij zgłoszenie]   │ │
│ │ │ Np. mam problem z ...    │ │  └───────────────────────┘ │
│ │ └──────────────────────────┘ │                            │
│ └──────────────────────────────┘                            │
├──────────────────────────────────────────────────────────────┤
│ Płatność po lekcji — bez opłat online.                       │
└──────────────────────────────────────────────────────────────┘
```

## 4. Wireframe — mobile

```text
┌───────────────────────────────┐
│ MaturaKorki      Wróć do prof.│
├───────────────────────────────┤
│ Krok 1 z 3 · Termin           │
│ (MK) Michał K. ✓              │
│ Rozszerzenie · 110 zł/h       │
│                               │
│ Wybierz termin                │
│ [czw. 29.10] [pt. 30.10] ...  │
│ [16:00] [17:00] [18:00]       │
│ [19:00] [—] [—]               │
│                               │
│ Twoja notatka (opcjonalnie)   │
│ ┌───────────────────────────┐ │
│ │ Np. mam problem z wektorami│ │
│ └───────────────────────────┘ │
│                               │
│ Podsumowanie                  │
│ Lekcja 60 min          110 zł │
│ Płatność po lekcji            │
│                               │
│ █ Wyślij zgłoszenie █         │
└───────────────────────────────┘
```

## 5. Komponenty

`MinimalHeader`, `Stepper`, `Avatar`, `Badge`, `SlotPicker`, `Textarea`, `SummaryCard`, `Button`, `Alert`, `Modal` (auth), `Toast`.

## 6. Copy PL

### Header i stepper

- `Wróć do profilu`
- `Termin` · `Dane` · `Potwierdzenie`
- Mobile: `Krok 1 z 3 · Termin`

### Podsumowanie korepetytora

- `Michał K.` · `Profil zatwierdzony`
- `Rozszerzenie` · `Geometria analityczna`
- `110 zł/h` · `60 min` · `online`

### Wybór terminu

- `Wybierz termin`
- Dni: `czw. 29.10` · `pt. 30.10` · `sob. 31.10` · `pon. 02.11` · `wt. 03.11`
- Godziny: `16:00` · `17:00` · `18:00` · `19:00`
- `Strefa czasowa: Europe/Warsaw`

### Notatka

- `Twoja notatka (opcjonalnie)`
- Placeholder: `Np. mam problem z wektorami. Max 300 znaków.`
- Licznik: `0/300`

### Podsumowanie

- `Podsumowanie`
- `Lekcja 60 min` — `110 zł`
- `Płatność po lekcji`
- `Bez opłat online.`
- `Wyślij zgłoszenie`

### Logowanie (overlay)

- `Zaloguj się, aby zarezerwować`
- `E-mail` — placeholder `twoj@email.pl`
- `Hasło`
- `Zaloguj się`
- `Nie masz konta? Zarejestruj się`
- `Anuluj`

### Potwierdzenie

- `Zgłoszenie wysłane`
- `Michał K. potwierdzi termin w swoim panelu. Status: Oczekuje na akceptację.`
- `Przejdź do moich lekcji`
- `Wróć do profilu`

### Błędy

- `Ten termin został właśnie zajęty. Wybierz inny.`
- `Brak wolnych terminów w tym tygodniu. Sprawdź później.`
- `Notatka może mieć maksymalnie 300 znaków.`

## 7. Stany

| Stan | Zachowanie |
|---|---|
| Krok 1 — domyślny | wybrany pierwszy dostępny dzień |
| Krok 2 — dane | notatka + podsumowanie |
| Krok 3 — potwierdzenie | status `pending` + CTA do panelu |
| Gość | modal logowania, po sukcesie powrót do S4 z zachowanym slotem |
| Slot zajęty | Alert + odświeżenie SlotPicker |
| Brak slotów | EmptyState + `Wróć do profilu` |
| Błąd walidacji | komunikat przy polu |

## 8. Responsywność

- Desktop: 7/5 kolumny, sticky podsumowanie.
- Tablet: 1 kolumna, podsumowanie pod slotami.
- Mobile: sticky CTA na dole, padding-bottom 96 px.
- Slot grid: 3 kolumny mobile, 4 desktop.

## 9. Dostępność

- Sloty to przyciski z `aria-pressed`; niedostępne mają `disabled`.
- Stepper ma `aria-current="step"`.
- Modal: focus trap, Escape, powrót focusu.
- Błędy mają `role="alert"`.
- Target 44 px; kontrast AA.

## 10. Prompt do Stitcha

Prefiks: globalny styl z `10-ekran-01-landing.md` §10.

```text
Design a desktop booking page (1280x1024) for MaturaKorki, same visual system as the landing page: paper #FBF8F3, surface #FFFFFF, ink #14213D, primary #1F5F5B, accent #E8A33D, Source Serif 4 headings, Inter UI, 12-column grid, max width 1200px, 8px radius, no gradients.

Sections:
1. Minimal header: wordmark "MaturaKorki" left, text link "Wróć do profilu" right.
2. Horizontal stepper: "1 Termin" active, "2 Dane", "3 Potwierdzenie".
3. Tutor summary card: avatar initials "MK", "Michał K." with verified badge, "Rozszerzenie", "Geometria analityczna", "110 zł/h · 60 min · online".
4. Two columns (7/5). Left: "Wybierz termin" with a horizontal row of day chips "czw. 29.10", "pt. 30.10", "sob. 31.10", "pon. 02.11", "wt. 03.11"; a 4-column time grid with "16:00", "17:00", "18:00", "19:00" (one disabled); "Twoja notatka (opcjonalnie)" textarea with placeholder "Np. mam problem z wektorami. Max 300 znaków." and counter "0/300"; small text "Strefa czasowa: Europe/Warsaw".
   Right: sticky summary card "Podsumowanie" with "Lekcja 60 min — 110 zł", "Płatność po lekcji", "Bez opłat online.", primary button "Wyślij zgłoszenie".
5. Bottom note: "Płatność po lekcji — bez opłat online."

Use exact Polish copy. No payment form, no mode filter, no trial lesson.
```

Mobile prompt:

```text
Adapt the booking page to 390x844: minimal header, compact stepper "Krok 1 z 3 · Termin", compact tutor summary, day chips horizontally scrollable, 3-column time grid, note textarea, summary block and a sticky bottom primary button "Wyślij zgłoszenie". Keep 96px bottom padding. No horizontal scroll at 360px.
```

## 11. Checklista akceptacji

- [ ] minimal header + `Wróć do profilu`
- [ ] stepper 3 kroki
- [ ] podsumowanie korepetytora z ceną i 60 min
- [ ] 5 dni + siatka godzin
- [ ] notatka z licznikiem 0/300
- [ ] podsumowanie ceny i `Płatność po lekcji`
- [ ] CTA `Wyślij zgłoszenie`
- [ ] stan logowania, slot zajęty, brak slotów, potwierdzenie
- [ ] brak płatności online i lekcji próbnej
- [ ] mobile bez horizontal scrolla

# Prompty do Stitcha — S2–S5

## Jak używać

1. Otwórz projekt `stitch_maturakorki_tutoring_marketplace` (ten sam co S1).
2. Wklej **Globalny styl** + prompt ekranu (desktop).
3. Wygeneruj, wybierz najlepszy wariant.
4. Wygeneruj wersję mobile tym samym promptem mobile.
5. Nie dodawaj sekcji, których nie ma w promptcie.
6. Copy może się minimalnie różnić — popraw tylko kluczowe teksty (H1, CTA, ceny, statusy).
7. Nie generuj S6/S7.

Jeśli Stitch utnie prompt: wklej najpierw globalny styl, potem sekcje 1–4, a po wygenerowaniu dopisz resztę jako iterację.

---

## Globalny styl

```text
Design for MaturaKorki, a Polish marketplace for high-school math tutoring for the matura exam. Visual system: warm academic "paper and ink". Page background #FBF8F3, cards #FFFFFF, alternate sections #F3EEE6, text #14213D, muted text #5C6675, primary #1F5F5B, primary soft #E3F0ED, accent #E8A33D, borders #E4DED3. Headings: Fraunces 600. UI/body: Inter. 12-column grid, max content width 1200px, 12px card radius, subtle shadows, Lucide icons, 1.75 stroke. No gradients, no purple, no 3D, no emoji, no stock handshake photos. Mobile-first. Use the exact Polish copy provided; do not translate, do not add sections, do not use lorem ipsum.
```

---

# S2 — Wyniki + filtry

## Desktop 1440×1024

```text
Global style: MaturaKorki paper & ink system (Fraunces + Inter, #FBF8F3/#FFFFFF/#14213D/#1F5F5B/#E8A33D, 12-column grid, max 1200px, 12px radius, no gradients).

Design a desktop results page (1440x1024).

1. Header: wordmark "MaturaKorki"; links "Jak to działa", "Korepetytorzy" (active), "Dla korepetytorów"; "Zaloguj się"; primary button "Znajdź korepetytora".
2. Page header: breadcrumb "Strona główna / Korepetytorzy"; H1 "Korepetytorzy z matematyki do matury"; subhead "8 profili · online · podstawa i rozszerzenie".
3. Filter bar: four selects — "Poziom — Dowolny poziom", "Dział — Dowolny dział", "Cena za godzinę — Dowolna", "Ocena — Dowolna"; ghost link "Wyczyść".
4. Active chips: "Rozszerzenie ×", "Geometria analityczna ×", "do 120 zł ×", "4.5+ ×".
5. Results header: "Znaleziono 8 korepetytorów" left; sort dropdown "Najbliższy termin" right.
6. Grid of 6 tutor cards in 3 columns. Each card: avatar initials, name with verified check, level badge, two topic chips, rating, price, next slot, ghost link "Zobacz profil".
   - Michał K. / Rozszerzenie / Geometria analityczna, Funkcje / 110 zł/h / 4.9 (23 opinie) / czw. 18:00
   - Anna W. / Podstawa i rozszerzenie / Prawdopodobieństwo, Ciągi / 95 zł/h / 4.8 (17 opinii) / dziś 19:00
   - Tomasz R. / Rozszerzenie / Trygonometria, Stereometria / 130 zł/h / 5.0 (11 opinii) / pt. 16:30
   - Karolina S. / Podstawa / Równania i nierówności, Planimetria / 85 zł/h / 4.7 (31 opinii) / wt. 17:00
   - Paweł M. / Rozszerzenie / Kombinatoryka, Prawdopodobieństwo / 120 zł/h / 4.6 (14 opinii) / sob. 10:00
   - Julia D. / Podstawa i rozszerzenie / Funkcje, Ciągi / 100 zł/h / 4.9 (28 opinii) / pon. 18:30
7. Centered button "Pokaż więcej"; note "Opinie tylko po zakończonej lekcji."
8. Footer: brand + "Korepetycje z matematyki do matury. Online, bez zgadywania.", columns "Uczniowie", "Korepetytorzy", "Kontakt", legal links.

No filter for mode. No trial lesson. Use exact Polish copy.
```

## Mobile 390×844

```text
Adapt the MaturaKorki results page to 390x844.

Header: wordmark left, "Zaloguj się" and hamburger right.
Page header: breadcrumb, H1 "Korepetytorzy z matematyki do matury", subhead "8 profili · online".
Controls: button "Filtry (3)" and sort control "Sortuj: najbliższy termin".
Active chips horizontally scrollable: "Rozszerzenie ×", "Geometria analityczna ×", "do 120 zł ×", "4.5+ ×".
Results count: "Znaleziono 8 korepetytorów".
Cards: 6 full-width stacked tutor cards with avatar initials, name, verified check, level badge, topic chips, rating, price, next slot, link "Zobacz profil".
Button "Pokaż więcej"; note "Opinie tylko po zakończonej lekcji."; footer stacked.
No horizontal scroll at 360px. Same paper & ink tokens.
```

---

# S3 — Profil korepetytora

## Desktop 1440×1024

```text
Global style: MaturaKorki paper & ink system (Fraunces + Inter, #FBF8F3/#FFFFFF/#14213D/#1F5F5B/#E8A33D, 12-column grid, max 1200px, 12px radius, no gradients).

Design a desktop tutor profile page (1440x1024).

1. Same public header as the landing page.
2. Breadcrumb "Korepetytorzy / Michał K."
3. Profile header card: avatar initials "MK", name "Michał K." with verified badge, subtitle "Korepetytor matematyki", rating "4.9 (23 opinie)", level badge "Rozszerzenie", topic chips "Geometria analityczna", "Funkcje", "Trygonometria", price "110 zł/h", "Online", primary button "Zarezerwuj termin".
4. Stats row: "120 lekcji · 4.9 · 23 opinie · 5 lat doświadczenia".
5. Two columns (8/4):
   Left: "O korepetytorze" with bio "Uczę matematyki od 5 lat. Pomagam maturzystom ogarnąć działy, które sprawiają najwięcej problemów — od funkcji po geometrię analityczną. Na zajęciach rozwiązujemy zadania maturalne i pracujemy nad strategią egzaminu."
   "Wykształcenie" with "Studia matematyczne · 5 lat doświadczenia w nauczaniu."
   "Działy" with chips.
   "Opinie" with three review cards: Zosia 5.0 "Dzięki Michałowi ogarnęłam wektory przed maturą. Konkretnie, bez lania wody."; Kuba 5.0 "Świetne tłumaczenie zadań z funkcji. Dużo przykładów maturalnych."; Ola 4.0 "Solidne zajęcia, ale warto wcześniej wysłać temat."; link "Zobacz wszystkie opinie →".
   Right: sticky booking card "Najbliższe terminy" with slot buttons "czw. 18:00", "pt. 16:30", "sob. 10:00", primary "Zarezerwuj termin", small text "Lekcja 60 min · online", "Płatność po lekcji", "Bez opłat online."
6. Same footer as the landing page.

No invented university names, no certificates. Use exact Polish copy.
```

## Mobile 390×844

```text
Adapt the MaturaKorki tutor profile to 390x844.

Header: logo + "Zaloguj się" + hamburger.
Back breadcrumb: "← Korepetytorzy / Michał K."
Profile block: avatar "MK", name "Michał K." with verified check, "4.9 (23 opinie)", badge "Rozszerzenie", "110 zł/h · online".
Sections stacked: "O korepetytorze" (same bio), "Wykształcenie", "Działy" chips, "Najbliższe terminy" with 3 slot buttons, "Opinie" with 3 review cards.
Sticky bottom primary button: "Zarezerwuj termin · 110 zł".
Keep 96px bottom padding so the CTA does not cover content. No horizontal scroll at 360px.
```

---

# S4 — Rezerwacja

## Desktop 1440×1024

```text
Global style: MaturaKorki paper & ink system (Fraunces + Inter, #FBF8F3/#FFFFFF/#14213D/#1F5F5B/#E8A33D, 12-column grid, max 1200px, 12px radius, no gradients).

Design a desktop booking page (1440x1024).

1. Minimal header: wordmark "MaturaKorki" left, text link "Wróć do profilu" right.
2. Horizontal stepper: "1 Termin" active, "2 Dane", "3 Potwierdzenie".
3. Tutor summary card: avatar "MK", "Michał K." with verified badge, "Rozszerzenie", "Geometria analityczna", "110 zł/h · 60 min · online".
4. Two columns (7/5):
   Left: "Wybierz termin" with day chips "czw. 29.10", "pt. 30.10", "sob. 31.10", "pon. 02.11", "wt. 03.11"; 4-column time grid "16:00", "17:00", "18:00", "19:00" (one disabled); "Twoja notatka (opcjonalnie)" textarea with placeholder "Np. mam problem z wektorami. Max 300 znaków." and counter "0/300"; small text "Strefa czasowa: Europe/Warsaw".
   Right: sticky "Podsumowanie" card with "Lekcja 60 min — 110 zł", "Płatność po lekcji", "Bez opłat online.", primary button "Wyślij zgłoszenie".
5. Bottom note: "Płatność po lekcji — bez opłat online."

No payment form, no trial lesson, no mode filter. Use exact Polish copy.
```

## Mobile 390×844

```text
Adapt the MaturaKorki booking page to 390x844.

Minimal header with logo and "Wróć do profilu".
Compact stepper: "Krok 1 z 3 · Termin".
Tutor summary: "MK", "Michał K.", "Rozszerzenie", "110 zł/h".
"Wybierz termin" with horizontally scrollable day chips and a 3-column time grid.
"Twoja notatka (opcjonalnie)" textarea with counter "0/300".
"Podsumowanie" with "Lekcja 60 min — 110 zł", "Płatność po lekcji".
Sticky bottom primary button "Wyślij zgłoszenie"; 96px bottom padding.
No horizontal scroll at 360px.
```

---

# S5 — Panel ucznia

## Desktop 1440×1024

```text
Global style: MaturaKorki paper & ink system (Fraunces + Inter, #FBF8F3/#FFFFFF/#14213D/#1F5F5B/#E8A33D, 12-column grid, max 1200px, 12px radius, no gradients).

Design a desktop student dashboard (1440x1024).

1. App header: wordmark "MaturaKorki", links "Szukaj" and "Moje lekcje" (active), circular avatar "Z".
2. Page header: H1 "Moje lekcje", subhead "Zarządzaj rezerwacjami i opiniami.", secondary button "Znajdź korepetytora".
3. Tabs: "Najbliższe" active, "Historia", "Opinie".
4. Lesson list max 900px wide, four full-width cards:
   - "czw. 29.10 · 18:00" / "Michał K." / "Geometria analityczna" / "110 zł" / warning badge "Oczekuje na akceptację" / ghost "Anuluj"
   - "pt. 30.10 · 19:00" / "Anna W." / "Prawdopodobieństwo" / "95 zł" / success badge "Zaakceptowana" / ghost "Anuluj"
   - "wt. 20.10 · 17:00" / "Tomasz R." / "Trygonometria" / "130 zł" / neutral badge "Zakończona" / primary link "Wystaw opinię"
   - "czw. 15.10 · 18:00" / "Karolina S." / "Planimetria" / "85 zł" / muted badge "Anulowana"
5. Minimal footer: "Pomoc", "Regulamin", "Polityka prywatności".

Statuses are text + color, never color alone. No chat, no payments. Use exact Polish copy.
```

## Mobile 390×844

```text
Adapt the MaturaKorki student dashboard to 390x844.

Compact app header: logo, avatar "Z", hamburger.
H1 "Moje lekcje", subhead "Zarządzaj rezerwacjami i opiniami."
Tabs horizontally scrollable: "Najbliższe", "Historia", "Opinie".
Four stacked lesson cards with the same data and status badges; actions full-width.
Minimal footer.
No horizontal scroll at 360px.
```

---

## Czego nie generować

- S6 panel korepetytora,
- S7 panel admina,
- ekranów płatności, czatu, wideorozmów,
- dodatkowych sekcji typu „karty wzorów CKE”,
- ciemnego motywu.

## Jeśli Stitch zmieni copy

Priorytet poprawek:
1. H1 i CTA,
2. ceny i statusy,
3. nazwy działów,
4. reszta może zostać, jeśli sens się zgadza.

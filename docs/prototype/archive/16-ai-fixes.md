# Prompt korekcyjny dla AI — S1–S5

## Jak używać

- **Figma Agent** działa tylko na tym, co jest w pliku Figma. Jeśli S2–S5 są tylko w Stitchu, wklej je do Figmy (jak S1) albo użyj Stitcha per ekran.
- Zduplikuj plik / zrób backup.
- Naprawiaj **po jednym ekranie**, nie wszystkie naraz.
- Po każdym ekranie sprawdź, czy AI nie zmieniło layoutu, copy ani kolejności sekcji.
- Jeśli coś przebuduje — Ctrl+Z i popraw tylko wskazany fragment.

## Prompt globalny

```text
You are fixing existing screens for MaturaKorki, a Polish math tutoring marketplace. Do not redesign, do not change layout, do not add or remove sections, do not change copy unless a correction explicitly says so. Apply only the corrections below.

GLOBAL DESIGN:
- Palette: page #FBF8F3, alternate sections #F3EEE6, cards #FFFFFF, text #14213D, muted #5C6675, primary #1F5F5B, primary soft #E3F0ED, accent #E8A33D, borders #E4DED3.
- Remove all Material 3 blue surfaces: #F8F9FF, #EFF4FF, #E5EEFF, #DFE9FB, #D9E3F5, #D1DBEC.
- Headings: Fraunces 600. Body/UI: Inter. Remove Newsreader.
- Header: remove the green circular person icon for guests. Keep logo, navigation, "Zaloguj się", CTA "Znajdź korepetytora".
- Footer: simple columns "Uczniowie", "Korepetytorzy", "Kontakt"; copyright "© 2026 MaturaKorki. Projekt studencki." Remove "Formuła 2023 i 2015", "Weryfikacja dyplomów", "Panel nauczyciela", "Cennik zajęć", "Pakiety Matura", "Pomoc i FAQ".
- Use consistent data: Michał K. — 4.9 (23 opinie), 110 zł/h; Anna W. — 4.8 (17 opinii), 95 zł/h; Tomasz R. — 5.0 (11 opinii), 130 zł/h; Karolina S. — 4.7 (31 opinii), 85 zł/h; Paweł M. — 4.6 (14 opinii), 120 zł/h; Julia D. — 4.9 (28 opinii), 100 zł/h.
- Dates: czw. 29.10, pt. 30.10, sob. 31.10, pon. 02.11, wt. 03.11.
- No trial lesson, payments, Google Meet, virtual whiteboard, CKE sheets, materials, video room, chat, tasks, refunds.
- Mobile: remove fixed bottom navigation. No fixed CTA may cover content. Place CTAs in normal flow or add 96px bottom padding; for static screens, in-flow is preferred.
```

## S2 — Wyniki

```text
Apply the global corrections to the results screen. Keep the layout: header, breadcrumb, H1, four filters, active chips, result count, six tutor cards, "Pokaż więcej", note, footer.

Additional fixes:
- Header: "Korepetytorzy" active.
- Remove the mobile bottom navigation (Szukaj, Lekcje, Wiadomości, Profil).
- Keep only the six seed tutors and their prices from the global data.
- Footer: simple columns and © 2026.
- Do not add new filters or sections.
```

## S3 — Profil

```text
Apply the global corrections to the tutor profile. Keep the layout: header, breadcrumb, profile card, stats, about, education, topics, reviews, booking card, footer.

Additional fixes:
- Rating: 4.9 (23 opinie). Change "23 oceny" to "23 opinie".
- Change "Wybierz dogodny termin pierwszej lekcji" to "Wybierz dogodny termin lekcji".
- Slot dates: use "czw. 29.10", "pt. 30.10", "sob. 31.10" instead of May dates.
- Topics: keep only "Geometria analityczna", "Funkcje", "Trygonometria". Remove "Stereometria", "Ciągi", "Rachunek różniczkowy".
- Footer: simple columns, © 2026.
- Mobile: remove the fixed sticky CTA that covers the bio. Place "Zarezerwuj termin · 110 zł" in normal flow after the booking card or at the end of the page.
```

## S4 — Rezerwacja

```text
Apply the global corrections to the booking screen. Keep the layout: minimal header, stepper, tutor summary, slot picker, note, summary, CTA.

Additional fixes:
- Rating: 4.9 (23 opinie). Remove "Zdawalność uczniów: 98%".
- Remove "Google Meet", "wirtualna tablica", "arkusze CKE", "Materiały na zajęcia", "Darmowe odwołanie do 12h przed terminem", "Szyfrowanie SSL", "podstawa programowa CKE 2024/2025".
- Set "Forma zajęć: Online."
- Keep the dates "czw. 29.10" … "wt. 03.11" and the time grid.
- Footer/copyright: © 2026, no 2024.
- Do not add payment or trial lesson.
```

## S5 — Panel ucznia

```text
Apply the global corrections to the student dashboard. Keep the layout: app header, H1, tabs, lesson cards, footer.

Additional fixes:
- Remove the mobile bottom navigation (Pulpit, Lekcje, Zadania, Czat, Profil).
- Remove the top stat cards and the matura countdown.
- Remove "Link do pokoju zajęć", "Przygotowanie do lekcji", "Rada przed powtórką" and any CKE content.
- Tabs: "Najbliższe 2", "Historia 2", "Opinie 1" — keep counts consistent.
- Cancelled card: remove "zwrócono".
- Make sure "Wystaw opinię" is visible and not covered by any fixed element.
- Footer: minimal, © 2026.
```

## Czego pilnować po AI

- [ ] brak niebieskich `#F8F9FF` / `#E5EEFF`
- [ ] Fraunces zamiast Newsreader
- [ ] brak zielonej ikony osoby w headerze
- [ ] brak fixed bottom nav na mobile
- [ ] brak fixed CTA zasłaniającego treść
- [ ] spójne oceny i daty
- [ ] brak Google Meet, CKE, materiałów, czatu, zadań, zwrotów
- [ ] copyright 2026
- [ ] layout i copy bez nieoczekiwanych zmian

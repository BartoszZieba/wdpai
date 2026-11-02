# Prototyp — MaturaKorki

Dokumentacja projektowa. Nazwa **MaturaKorki** jest robocza.

## Status

- [x] brief projektu
- [x] decyzje zakresowe
- [x] tokeny designu (zaktualizowane do finalnej Figmy: Source Serif 4 + Inter, 1280/390)
- [x] inwentarz komponentów
- [x] mapa przepływów i ekranów
- [x] ekran 01 — landing + wyszukiwarka
- [x] specyfikacje ekranów 02–05
- [x] 10 frame’ów Figma: 5 desktop + 5 mobile (`../../../figma_export/`)
- [x] PDF 10 stron — **do ponownego eksportu po poprawkach z audytu**
- [x] formularz zgłoszeniowy Lab 2 — wysłany
- [ ] korekty P0 z `../project/01-design-audit.md`
- [ ] ponowny eksport PDF w kolejności S1–S5

## Pliki

| Plik | Zawartość |
|---|---|
| `00-brief.md` | problem, persony, scenariusze, MVP, out-of-scope, przepływy |
| `01-design-tokens.md` | kolory, typografia, spacing, grid, promienie, cienie, dostępność |
| `02-components.md` | biblioteka komponentów, warianty i stany |
| `03-flows.md` | aktorzy, mapa ekranów, przepływy, statusy rezerwacji |
| `10-ekran-01-landing.md` | spec ekranu 01 + copy PL |
| `11-ekran-02-wyniki.md` | wyniki + filtry |
| `12-ekran-03-profil.md` | profil korepetytora |
| `13-ekran-04-rezerwacja.md` | rezerwacja + logowanie + potwierdzenie |
| `14-ekran-05-panel.md` | panel ucznia |
| `18-lab2-demo.md` | scenariusz demo Lab 2 |
| `figma/maturakorki.tokens.json` | tokeny do importu Figma Variables |
| `archive/` | historyczne prompty Stitch i stare `DESIGN.md` — nie źródło prawdy |

## Zasady pracy

- **Figma jest źródłem prawdy** dla wyglądu i copy; `docs/` tylko opisuje.
- **Copy PL jest źródłem prawdy** — nie tłumaczymy i nie wymyślamy nowych sekcji.
- **Tokeny są wspólne** dla Figma Variables i późniejszego CSS (Lab 3).
- **Mobile first**: projektujemy 390 px, potem rozszerzamy do 1280 px (max treści 1200 px).
- **Jeden główny CTA na ekran.**
- Stany (puste, błąd, `pending`, brak logowania) są częścią projektu, nie dodatkiem.
- Historyczne pliki ze Stitcha są w `archive/`; nie wracamy do nich przy implementacji.

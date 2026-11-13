# MaturaKorki — plan projektu WDPAI

Data: 2026-11-02  
Źródło wymagań: `projekt_wymagania.txt` = `https://adrianwii.pl/api/content/39` (Lab 15, 36 kryteriów).  
Stan wyjściowy: `main` = `64817a7` (Lab 2 + Lab 4, bez bazy, CSS, auth i JS).

## 1. Wniosek z Lab 15

Projekt ocenia **36 kryteriów**, po 1 / 0,5 / 0 pkt. Warunek konieczny: backend obiektowy — projekt strukturalny = 2.0 i brak punktowania pozostałych kryteriów.

Progi: 34–36 = 5.0; 29,5–33,5 = 4.5; 26–29 = 4.0; 22–25,5 = 3.5; 18,5–21,5 = 3.0; 0–18 = 2.0.

Aktualny szkielet Lab 2 realnie daje około **7–8 / 36 pkt (2.0)**. To normalny etap pośredni, ale nie jest jeszcze projektem zaliczeniowym.

## 2. Czy laby 1–15 pokrywają 36 kryteriów?

**Prawie tak, ale nie 1:1.** Lab 1–15 to dobra ścieżka nauczania, jednak część kryteriów nie ma osobnego laboratorium albo laboratorium tylko o nich wspomina. Trzeba je dołożyć samodzielnie.

| Lab | Temat | Pokrywa kryteria | Uwagi |
|---|---|---|---|
| 1 | Git, Docker, IDE | 1 (część), 2, 7, 35 | README, Docker, Git, `.env` |
| 2 | Prototyp, MVC, routing, widoki, Composer | 3, 4, 5 (część), 8, 9 | brakuje diagramu architektury i realnego flow |
| 3 | CSS | 16, 17 | tylko jeden widok, reszta projektu później |
| 4 | AI / vibe coding | 29 (część) | brak bezpośredniego kryterium; nie zastępuje kodu |
| 5 | Theme data, dark/light, WCAG | 18, 19 | trzeba dodać raport WCAG |
| 6 | PHP: formularze, walidacja, przekierowania, błędy | 9, 13, 20–24 (część), 27 (część) | brakuje pełnego auth i CSRF |
| 7 | PostgreSQL, ERD, SQL, PDO | 6, 10, 11, 12, 26 | trzeba dodać eksport `.sql` i FK |
| 8 | OOP, modele, repozytoria, CRUD, mapowanie | 5, 10, 26, 28, 29 | kluczowy lab dla warunku koniecznego |
| 9 | Auth, sesja, role, uprawnienia, logout | 20, 21, 22, 23, 24 | pełny przepływ konta |
| 10 | JavaScript: DOM, zdarzenia, walidacja | 14 | trzeba podzielić kod na moduły |
| 11 | Fetch API / AJAX | 15 | brak materiałów w API — zrobić z opisu |
| 12 | Security Bingo, CSRF, XSS, SQLi, sesje | 27 | obowiązkowa tabela dowodów w README |
| 13 | Upload, Mailpit, CRON, streaming, mapy, `.env` | 32, 33, 34, 35 | treść Lab 13 = tylko Mailpit; CRON i upload dołożymy |
| 14 | Testy, WCAG, tłumaczenia, dokumentacja, eksport DB, deploy | 1, 12, 19, 30, 31, 36 | treść Lab 14 = tylko deploy; resztę dołożymy |
| 15 | Ewaluacja | — | checklista końcowa |

### Czego laby nie dowożą same

| Kryterium | Problem | Rozwiązanie |
|---|---|---|
| 25 — widok / trigger / funkcja / transakcja | nie ma osobnego labu | widok średniej ocen, trigger `updated_at`, transakcja rezerwacji |
| 30 — tłumaczenia PL/EN | tylko opis w Lab 14 | `lang/pl.php`, `lang/en.php`, `Translator`, przełącznik języka |
| 31 — testy jednostkowe | tylko opis w Lab 14 | PHPUnit + testy `BookingService`, walidacji, routera |
| 32 — CRON | tylko opis w Lab 13 | `bin/cron/send-lesson-reminders.php` + dokumentacja |
| 34 — upload zdjęcia | tylko opis w Lab 13 | avatar użytkownika, `finfo`, limit, losowa nazwa, ścieżka w DB |
| 36 — deploy | Lab 14 opisuje VPS, ale nie jest obowiązkowy na labie | Azure (próba) + publiczny URL w README |

Wniosek: **laby 1–15 pokrywają około 80% kryteriów**. Reszta to świadome dodatki projektowe, nie „rzeczy poza kursem”.

## 3. Audyt obecnego repo

Legenda: ✅ działa, 🟡 częściowo, ❌ brak.

| # | Kryterium | Stan | Co brakuje |
|---|---|---|---|
| 1 | README | 🟡 | realne screeny, architektura, ERD, testy, deploy, dane demo |
| 2 | Docker | 🟡 | aplikacja nie korzysta jeszcze z PostgreSQL; brak schematu |
| 3 | Architektura | 🟡 | brak diagramu warstw i repozytoriów/serwisów |
| 4 | Routing | ✅ | jest statyczna trasa, `{id}`, query, 404; dodać więcej metod i walidację 400 |
| 5 | Obiektowy backend | 🟡 | są klasy, ale kontrolery trzymają dane; brak interfejsów/repo |
| 6 | ERD Mermaid | ❌ | brak |
| 7 | Git | ✅ | małe commity, branche, PR, merge commit |
| 8 | Realizacja tematu | ❌ | widoki są statyczne, brak przepływu rezerwacji |
| 9 | HTML | ✅ | semantyka, partiale, formularz POST, błędy pól i CSRF; brak auth |
| 10 | PostgreSQL | ❌ | jest kontener, brak użycia w aplikacji |
| 11 | Złożoność bazy | ❌ | brak tabel |
| 12 | Eksport `.sql` | ❌ | brak |
| 13 | PHP | ✅ | typy, `strict_types`, brak warningów |
| 14 | JavaScript | 🟡 | `themes.js`: DOM, eventy, `localStorage`; brak Fetch i walidacji formularzy |
| 15 | Fetch API | ❌ | brak |
| 16 | Design | 🟡 | CSS gotowy na `feature/lab3-css`; czeka na merge |
| 17 | Responsywność | 🟡 | 360/390/768/1280 bez poziomego scrolla; czeka na merge |
| 18 | Dark/light | 🟡 | przełącznik + system + `localStorage`; do potwierdzenia w audycie WCAG |
| 19 | WCAG | ❌ | brak raportu |
| 20 | Logowanie | ❌ | brak |
| 21 | Sesja | ❌ | brak |
| 22 | Uprawnienia | ❌ | brak |
| 23 | Role | ❌ | brak |
| 24 | Wylogowanie | ❌ | brak |
| 25 | Widok/trigger/funkcja/transakcja | ❌ | brak |
| 26 | JOIN + FK | ❌ | brak |
| 27 | Security Bingo | 🟡 | CSRF, escaping i sesja są; brak SQLi/auth/upload demo |
| 28 | Brak replikacji | 🟡 | są partiale i `AppController::e()`, ale logika jest w kontrolerach |
| 29 | Czystość kodu | 🟡 | prosty kod, ale brak warstw i testów |
| 30 | Tłumaczenia | ❌ | brak |
| 31 | Testy | ❌ | brak |
| 32 | CRON | ❌ | brak |
| 33 | PHP Mailer | ❌ | Mailpit jest, ale brak wysyłki |
| 34 | Upload | ❌ | brak |
| 35 | `.env` | ✅ | `.env.example`, brak sekretów w repo |
| 36 | Deploy | ❌ | brak publicznego adresu |

## 4. Docelowa struktura repo

```text
repo/
├── public/
│   ├── index.php
│   ├── css/style.css
│   ├── js/
│   │   ├── app.js
│   │   ├── themes.js
│   │   ├── filters.js
│   │   └── booking.js
│   ├── uploads/avatars/       # albo poza public, z kontrolą dostępu
│   └── views/
│       ├── partials/
│       ├── auth/
│       ├── tutor/
│       ├── admin/
│       └── ...
├── src/
│   ├── Routing.php
│   ├── Database.php
│   ├── controllers/
│   ├── models/
│   ├── repositories/
│   ├── services/
│   ├── I18n/
│   └── Support/
├── database/
│   ├── schema.sql
│   ├── seed.sql
│   └── migrations/
├── tests/
│   ├── Unit/
│   └── Integration/
├── bin/cron/
├── lang/
│   ├── pl.php
│   └── en.php
├── docker/
├── docs/
│   ├── prototype/             # obecne specyfikacje
│   └── project/               # plan, audyt, raporty
├── composer.json
├── docker-compose.yaml
├── README.md
└── AGENTS.md
```

Zasady:
- `public/` = jedyny publiczny katalog.
- `vendor/` i `.env` poza repo.
- Żadnego SQL w kontrolerach ani HTML w modelach.
- Wspólne partiale: `header`, `nav`, `footer`, `flash`, `field-error`, `tutor-card`, `status-badge`.
- Cały CSS w `public/css/style.css`, żadnych inline styles.
- Cały JS w `public/js/*.js`, bez skryptów kopiowanych do widoków.

## 5. Docelowy routing i role

### Publiczne / gość

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/` | landing |
| GET | `/tutors` | lista + filtry `level`, `topic`, `price`, `rating`, `sort` |
| GET | `/tutors/{id}` | profil korepetytora |
| GET/POST | `/login` | logowanie |
| GET/POST | `/register` | rejestracja |
| POST | `/logout` | wylogowanie |

### Uczeń

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/booking` | formularz rezerwacji (gość → auth modal) |
| POST | `/booking` | zapis rezerwacji, CSRF, transakcja |
| GET | `/dashboard` | moje lekcje, tabs `upcoming/history/reviews` |
| POST | `/bookings/{id}/cancel` | anulowanie |
| POST | `/bookings/{id}/review` | opinia po `completed` |

### Korepetytor

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/tutor/dashboard` | zgłoszenia + grafik |
| GET/POST | `/tutor/profile` | profil, cena, działy |
| GET/POST | `/tutor/availability` | sloty 60 min |
| POST | `/tutor/bookings/{id}/accept` | akceptacja |
| POST | `/tutor/bookings/{id}/decline` | odrzucenie |
| POST | `/tutor/bookings/{id}/complete` | zakończenie |

### Admin

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/admin` | profile `pending`, opinie, działy |
| POST | `/admin/tutors/{id}/approve` | aktywacja profilu |
| POST | `/admin/tutors/{id}/reject` | odrzucenie |
| POST | `/admin/reviews/{id}/hide` | ukrycie opinii |
| POST | `/admin/reviews/{id}/restore` | przywrócenie |
| GET/POST | `/admin/topics` | działy maturalne |

### API / Fetch

| Metoda | Ścieżka | Akcja |
|---|---|---|
| GET | `/api/tutors?level=&topic=&price=&rating=&sort=` | JSON lista |
| GET | `/api/tutors/{id}/slots` | wolne sloty |
| POST | `/api/bookings` | rezerwacja JSON |
| GET | `/api/translations/{locale}` | opcjonalnie |

`/api/*` zwraca JSON, kody 200/400/401/403/404/409/422 i obsługuje CSRF dla POST.

## 6. Model bazy (minimum)

```text
users
  id, name, email UNIQUE, password_hash, role ENUM(student,tutor,admin),
  locale, avatar_path, created_at, updated_at

tutor_profiles
  id, user_id UNIQUE FK, headline, bio, education,
  price_per_hour, level, status ENUM(draft,pending,active,rejected),
  created_at, updated_at

topics
  id, name, slug UNIQUE

tutor_topics
  tutor_profile_id FK, topic_id FK, PRIMARY KEY(tutor_profile_id, topic_id)

availability_slots
  id, tutor_profile_id FK, starts_at TIMESTAMPTZ,
  duration_min DEFAULT 60, created_at,
  UNIQUE(tutor_profile_id, starts_at)

bookings
  id, student_id FK, tutor_profile_id FK, slot_id UNIQUE FK,
  topic_id FK, note, price, status ENUM(pending,accepted,declined,completed,cancelled),
  reminder_sent_at, created_at, updated_at

reviews
  id, booking_id UNIQUE FK, student_id FK, tutor_profile_id FK,
  rating 1..5, comment, hidden BOOLEAN, created_at

booking_status_history
  id, booking_id FK, old_status, new_status, changed_by FK, created_at
```

Dodatki pod kryteria:
- **Widok** `tutor_ratings`: średnia i liczba opinii z `hidden = false`.
- **Trigger** `set_updated_at` dla `users`, `tutor_profiles`, `bookings`.
- **Funkcja** `tutor_rating(tutor_id)` albo widok.
- **Transakcja** w `BookingService::create()`: `SELECT ... FOR UPDATE` na slot, sprawdzenie braku aktywnej rezerwacji, insert, commit.
- **Partial unique index**: jedna aktywna rezerwacja na slot:
  `CREATE UNIQUE INDEX ... ON bookings(slot_id) WHERE status IN ('pending','accepted');`
- FK: `ON DELETE CASCADE` dla `tutor_topics`, `RESTRICT` dla `bookings`/`reviews`, `SET NULL` dla `avatar_path` (jeśli potrzeba).
- Seed: 10 korepetytorów, 3 uczniów, admin, działy, sloty, 4 rezerwacje, 3 opinie.

## 7. Plan realizacji

### P0 — zamrożenie designu i porządki (teraz)

- [ ] Wyeksportować poprawione 10 frame’ów z Figmy (PNG 1x desktop, 2x mobile + PDF).
- [x] Sprawdzić tokeny: tło `#FBF8F3`, primary `#1F5F5B`, akcent `#E8A33D`, fonty **Source Serif 4 / Inter**.
- [x] Zaktualizować `docs/prototype/01-design-tokens.md` do finalnej Figmy (font, 1280/390, promienie).
- [x] Uporządkować `docs/prototype/`: historyczne pliki w `archive/`.
- [x] S6/S7: **oba minimalne, ale funkcjonalne**; różnice w `02-panele-s6-s7.md`.
- [x] Deploy: **Azure**; bez publicznego URL kryterium 36 = 0.
- [x] Commitować `docs/` na branchu `docs/project-plan` (nie mieszać z kodem).
- [x] Uporządkować surowe screeny/PDF: `wdpai/figma_export/` = finalne źródło, `wdpai/archive/` = historia; repo zawiera tylko `docs/`.

### P1 — Lab 3: CSS i responsywność

Kryteria: 16, 17; Lab 3: 7 punktów.

- [x] `public/css/tokens.css` z tokenami `:root` (min. 8 zmiennych) + `style.css`.
- [x] Typografia, kolory, spacing, border, radius, shadows.
- [x] Layout S1 na Flexbox/Grid; karty na `flex-wrap`.
- [x] Breakpointy 480/768/1024/1280 + test 320–1440.
- [x] `:hover`, `:focus-visible`, `prefers-reduced-motion`, `@media print`.
- [x] Wspólny `layout.html.php`, mobilny hamburger, nakładka statusu online, fixed back-to-top.
- [x] Podłączyć CSS do wszystkich widoków.
- [x] Małe commity: tokens → layout → components → responsive.

Status: gotowe na branchu `feature/lab3-css` + `feature/lecture-css`; commity `39a5804`, `d60ddc8`, `9130e2f`, `a98f014`, `6ff189b`. Szczegóły: `docs/project/03-lab3-css.md`, `docs/project/05-lecture-css.md`. Merge dopiero po akceptacji użytkownika.

### P2 — Lab 6/7/8: PHP, PostgreSQL, OOP

Kryteria: 5, 6, 10, 11, 12, 26, 28, 29.

- [x] Lab 6: `POST /booking`, walidacja, CSRF, PRG, flash, 500 (dane w sesji, bez DB).
- [ ] `database/schema.sql` + `seed.sql` + `docker/db/init`.
- [ ] `src/Database.php` (PDO, DSN z `.env`).
- [ ] `src/models/*`, `src/repositories/*`, `src/services/*`.
- [ ] Podłączyć `/tutors`, `/tutors/{id}` do DB.
- [ ] ERD Mermaid w README.
- [ ] Eksport `.sql` z schematem i danymi demo.
- [ ] Test czystej bazy: `docker compose down -v && up`.

### P3 — Lab 9: auth, sesja, role

Kryteria: 20–24.

- [x] Formularze `/login` i `/register` + walidacja + CSRF (UI przed bazą).
- [ ] Tabela `users`, `password_hash`, `password_verify`.
- [ ] `SecurityController` login/register/logout z prawdziwą sesją.
- [ ] `session_regenerate_id(true)`, cookie HttpOnly/SameSite.
- [ ] Role `student/tutor/admin`, middleware/guard.
- [ ] Chronione trasy i 401/403.
- [ ] Konta demo w README.

### P4 — rezerwacje, panele, JS, Fetch

Kryteria: 8, 14, 15, 22, 23, 25, 26.

- [ ] `BookingService` + transakcja + statusy.
- [x] POST `/booking` z CSRF i walidacją (sesja; DB/transakcja w P2).
- [ ] Panel ucznia z anulowaniem i opinią.
- [ ] Panel korepetytora: akceptuj/odrzuć/zakończ, sloty.
- [ ] Panel admina: profile/opinie/działy.
- [ ] `public/js/filters.js` — Fetch `/api/tutors`.
- [ ] `public/js/booking.js` — sloty i walidacja.
- [x] `public/js/themes.js` — dark/light (wdrożone wcześniej, przed P4).

### P5 — Lab 5/12: theme, WCAG, security

Kryteria: 18, 19, 27.

- [x] `data-theme` + `localStorage` + `prefers-color-scheme` + skrypt w `<head>`.
- [ ] Kontrast AA, focus, target 44 px, labels.
- [ ] Raport Lighthouse/axe/WAVE ze zrzutem i datą.
- [ ] Security Bingo: hash, prepared statements, walidacja, escaping, CSRF, auth, upload.
- [ ] Tabela dowodów w README (plik + linia + demo).

### P6 — Lab 13/14: mail, CRON, upload, tłumaczenia, testy, deploy

Kryteria: 30–36.

- [ ] PHPMailer + Mailpit `mailpit:1025`; welcome + reminder.
- [ ] `bin/cron/send-lesson-reminders.php`, idempotencja, log.
- [ ] Upload avatara: MIME, rozmiar, losowa nazwa, ścieżka w DB.
- [ ] `Translator` + `lang/pl.php` + `lang/en.php`; walidacja i błędy.
- [ ] PHPUnit: poprawne i błędne przypadki; `composer test`.
- [ ] README finalne: screeny 5+5, ERD, architektura, testy, WCAG, Security Bingo, CRON, deploy.
- [ ] Deploy publiczny na Azure + link w README.

### P7 — Lab 15: audyt i demo

- [ ] Przejść 36 kryteriów po kolei i wpisać dowód.
- [ ] Czysty clone → `.env` → `docker compose up --build` → import DB → testy.
- [ ] Demo 10–12 min: landing → filtr → profil → rezerwacja → panel → akceptacja → opinia.
- [ ] Sprawdzić 360 px, 768 px, 1280 px.
- [ ] Zamrozić `main`, zaktualizować README.

## 8. Zgodność z Figmą

Zasady:
- **Figma jest źródłem prawdy** dla wyglądu i copy; `docs/prototype/*.md` tylko opisuje.
- 10 frame’ów: `D/01-Landing` … `D/05-Panel`, `M/01-Landing` … `M/05-Panel`.
- S6/S7 (korepetytor/admin) nie są w PDF, ale potrzebne do kryterium 23 — robimy je jako warianty S5 w tym samym stylu. Szczegóły: `02-panele-s6-s7.md`.
- Nie kopiujemy HTML ze Stitcha 1:1; odtwarzamy układ w semantic HTML + CSS.
- Tokeny CSS muszą odpowiadać Figma Variables; przy różnicy aktualizujemy dokument, nie wymyślamy nowych kolorów.
- Fonty: **Source Serif 4 (nagłówki) + Inter (UI/body)**; jeśli Figma używa innego serifa, zmieniamy jeden token, nie mieszamy fontów.

## 9. Eksport poprawionej Figmy

1. Uporządkuj stronę `Screens`:
   - Section `Desktop 1280` — 5 frame’ów,
   - Section `Mobile 390` — 5 frame’ów.
2. Nazwy: `D/01-Landing`, `D/02-Wyniki`, `D/03-Profil`, `D/04-Rezerwacja`, `D/05-Panel`; analogicznie `M/...`.
3. Zaznacz 10 frame’ów → **Export**:
   - desktop: PNG **1x**,
   - mobile: PNG **2x**,
   - dodatkowo PDF (wszystkie 10).
4. Zapisz do folderu:

```text
figma-export/
├── D-01-Landing.png
├── D-02-Wyniki.png
├── D-03-Profil.png
├── D-04-Rezerwacja.png
├── D-05-Panel.png
├── M-01-Landing.png
├── M-02-Wyniki.png
├── M-03-Profil.png
├── M-04-Rezerwacja.png
├── M-05-Panel.png
├── MaturaKorki-prototyp.pdf
└── tokens.md / design.md   # jeśli eksportujesz
```

5. Udostępnij link Figma: **Share → Anyone with the link → Can view**.
6. Nie eksportuj ukrytych instancji design systemów ani starych duplikatów.

## 10. Decyzje do podjęcia przed kodem

1. **Font:** **Source Serif 4** (nagłówki) + **Inter** (UI/body) — zgodnie z finalnym eksportem Figma; docs zaktualizowane.
2. **S6/S7:** **oba minimalne, ale funkcjonalne** — S6 „moje”, S7 „wszystkie”; szczegóły w `02-panele-s6-s7.md`.
3. **Deploy:** **Azure** (próba); publiczny URL musi trafić do README.
4. **Zakres v1:** 5 ekranów + S6/S7; bez rozszerzania poza MVP.
5. **Testy:** **najpierw stabilizacja funkcji, potem PHPUnit** (decyzja użytkownika).

## 11. Kolejność commitów

- `docs: add project plan and criteria audit`
- `chore: organize design exports`
- `feat: add design tokens and base styles`
- `feat: style landing page`
- `feat: add responsive layout`
- `feat: add database schema and seed`
- `feat: add repositories and services`
- `feat: add authentication and roles`
- `feat: add booking flow`
- `feat: add tutor and admin panels`
- `feat: add javascript and fetch api`
- `feat: add translations and tests`
- `docs: finalize README and demo`

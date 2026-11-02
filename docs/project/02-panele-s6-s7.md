# S6 / S7 — panel korepetytora i administratora

Dokument decyzyjny. Oba panele są potrzebne do pełnego flow i kryteriów 22–23 (uprawnienia i role). Nie są „extra” obok S5 — bez nich rezerwacja zostaje w `pending`.

## Wspólne

- Ten sam layout co S5: app header, H1, tabs, karty/tabele, badge statusów.
- Wejście tylko po zalogowaniu; rola sprawdzana na serwerze, nie w JS.
- Korepetytor widzi **tylko swoje** dane; admin widzi **wszystkie**.
- Student nie ma dostępu do S6/S7; korepetytor nie ma dostępu do S7.
- Jedno konto = jedna rola. Admin jest seedowany, bez publicznej rejestracji.
- Wspólne komponenty: `status-badge`, `lesson-card`, `empty-state`, `confirm-dialog`, `flash`.

## S6 — panel korepetytora

**Cel:** prowadzenie własnego profilu, grafiku i rezerwacji.

**Zakładki:**

1. **Profil**
   - bio, wykształcenie, poziom (`Podstawa` / `Rozszerzenie` / oba),
   - cena za godzinę,
   - działy (wybór z katalogu),
   - status profilu: `draft` / `pending` / `active` / `rejected`,
   - zapis tylko własnego profilu.

2. **Grafik**
   - lista slotów 60-minutowych (data + godzina),
   - dodanie slotu,
   - usunięcie slotu tylko bez aktywnej rezerwacji,
   - brak powtarzalności (jednorazowe sloty).

3. **Rezerwacje**
   - `pending` → akceptuj / odrzuć,
   - `accepted` → oznacz jako zakończoną,
   - widok notatki ucznia i tematu,
   - filtrowanie: nadchodzące / historia.

**Czego nie ma:** moderacji innych korepetytorów, edycji cudzych profili, zarządzania użytkownikami, moderacji opinii.

**Trasy:** `GET /tutor/dashboard`, `GET/POST /tutor/profile`, `GET/POST /tutor/availability`, `POST /tutor/bookings/{id}/accept|decline|complete`.

**Minimalny zakres na projekt:** 3 zakładki, 3 akcje na rezerwacji, dodawanie/usuwanie slotów. Bez wykresów i statystyk zaawansowanych.

## S7 — panel administratora

**Cel:** moderacja marketplace’u i dane słownikowe.

**Zakładki:**

1. **Korepetytorzy**
   - lista profili `pending`,
   - podgląd profilu,
   - akceptacja / odrzucenie,
   - zmiana `pending` → `active` / `rejected`,
   - brak edycji merytorycznej profilu (admin moderuje, nie tworzy bio).

2. **Opinie**
   - lista opinii, także zgłoszonych,
   - ukrycie / przywrócenie opinii,
   - ukryta opinia nie liczy się do średniej,
   - brak usuwania na twardo.

3. **Działy**
   - lista działów maturalnych,
   - dodanie / edycja nazwy i sluga,
   - dezaktywacja działu zamiast usuwania, jeśli ma powiązania.

**Czego nie ma:** zarządzania własnym profilem korepetytora (admin nie jest korepetytorem), tworzenia rezerwacji za ucznia, edycji cudzych rezerwacji poza moderacją.

**Trasy:** `GET /admin`, `POST /admin/tutors/{id}/approve|reject`, `POST /admin/reviews/{id}/hide|restore`, `GET/POST /admin/topics`.

**Minimalny zakres na projekt:** 3 zakładki, akceptacja/odrzucenie profilu, ukrycie/przywrócenie opinii, dodanie działu.

## Różnica w jednym zdaniu

**S6 = „moje”** (mój profil, mój grafik, moje rezerwacje).  
**S7 = „wszystkie”** (moderacja profili, opinii i słowników całej platformy).

## Konsekwencje dla bazy i auth

- `users.role`: `student` / `tutor` / `admin`.
- `tutor_profiles.user_id` — profil powiązany z kontem korepetytora.
- `tutor_profiles.status`: `draft` / `pending` / `active` / `rejected`.
- `reviews.hidden` — moderacja bez usuwania.
- `topics.active` — dezaktywacja zamiast delete.
- Guard: `requireRole('tutor')`, `requireRole('admin')`; dodatkowo `assertOwnTutorProfile($id)` dla S6.
- Admin seed: `admin@maturakorki.pl` + hasło w `.env`/seedzie demo, nie w kodzie.

## Kolejność implementacji

1. S6 „Rezerwacje” — odblokowuje flow `pending → accepted → completed`.
2. S6 „Grafik” — bez slotów nie ma rezerwacji.
3. S7 „Korepetytorzy” — bez akceptacji profil nie jest publiczny.
4. S7 „Opinie” — po zakończonej lekcji.
5. S7 „Działy” — na końcu; seed wystarcza do startu.

# Przepływy i mapa ekranów — MaturaKorki

## 1. Aktorzy i uprawnienia

| Aktor | Dostęp | Może |
|---|---|---|
| **Gość** | S1–S3 | przeglądać landing, wyniki, profile; rozpocząć rezerwację (zostanie poproszony o logowanie) |
| **Uczeń** | S1–S5 | rezerwować, anulować swoje lekcje, wystawiać opinie po `completed` |
| **Korepetytor** | S1–S3, S6 | edytować profil i dostępność, akceptować/odrzucać zgłoszenia, kończyć lekcje |
| **Admin** | S7 | zatwierdzać profile, moderować opinie, zarządzać działami |

Zasady:
- jedno konto = jedna rola (uczeń **albo** korepetytor),
- admin nie rejestruje się publicznie — konto seedowane,
- profil korepetytora działa publicznie tylko po statusie `active`,
- gość może przeglądać, ale rezerwacja wymaga logowania.

## 2. Mapa ekranów

| ID | Ekran | Dostęp | Flow | Mobile | Desktop |
|---|---|---|---|---|---|
| S1 | Landing + wyszukiwarka | publiczny | 1 | `M/01-Landing` | `D/01-Landing` |
| S2 | Wyniki + filtry | publiczny | 1 | `M/02-Wyniki` | `D/02-Wyniki` |
| S3 | Profil korepetytora | publiczny | 1 | `M/03-Profil` | `D/03-Profil` |
| S4 | Rezerwacja + auth + potwierdzenie | uczeń | 1 | `M/04-Rezerwacja` | `D/04-Rezerwacja` |
| S5 | Panel ucznia | uczeń | 1 | `M/05-Panel-ucznia` | `D/05-Panel-ucznia` |
| S6 | Panel korepetytora | korepetytor | 2 | `M/06-Panel-korepetytora` | `D/06-Panel-korepetytora` |
| S7 | Panel admina | admin | 3 | `M/07-Admin` | `D/07-Admin` |
| — | Logowanie / rejestracja | — | 1/2 | modal lub krok w S4 | modal |

**10 ekranów do PDF:** S1–S5 × mobile + desktop.
**Dodatkowe, jeśli starczy czasu:** S6 i S7 (kolejne 4 frame’y).

## 3. Flow 1 — uczeń: od wejścia do opinii

1. **S1 Landing** — wybór poziomu i działu → `Szukaj korepetytora`.
2. **S2 Wyniki** — filtry (dział, poziom, cena, ocena), sortowanie (najbliższy termin / cena / ocena), karty korepetytorów.
3. **S3 Profil** — bio, wykształcenie, działy, cennik, dostępność, opinie → `Zarezerwuj termin`.
4. **S4 Rezerwacja**
   - jeśli gość: logowanie/rejestracja w modalu, po sukcesie powrót do S4 z zachowanym slotem,
   - wybór slotu (SlotPicker), notatka (opcjonalna, max 300 znaków), podsumowanie ceny,
   - `Wyślij zgłoszenie` → status `pending` → ekran potwierdzenia.
5. **S5 Panel ucznia** — lekcja widoczna jako `Oczekuje`.
6. Korepetytor akceptuje → status `accepted` (w przyszłości mail).
7. Po lekcji korepetytor oznacza `completed` → uczeń widzi `Wystaw opinię`.
8. Opinia (1–5 + komentarz) → pojawia się na profilu korepetytora.

**Ścieżki alternatywne:**
- korepetytor odrzuca → `declined`, slot wraca, uczeń widzi powód (opcjonalnie),
- uczeń anuluje `pending`/`accepted` → `cancelled`, slot wraca,
- slot zajęty w trakcie → komunikat „Ten termin został właśnie zajęty. Wybierz inny.”,
- brak logowania → modal auth, bez utraty wybranego terminu.

## 4. Flow 2 — korepetytor: profil, grafik, zgłoszenia

1. Rejestracja jako **korepetytor**.
2. Formularz profilu: imię, headline, bio, wykształcenie, działy, poziom, cena/h.
3. Dodanie dostępności: pojedyncze sloty 60 min (data + godzina), bez powtarzalności.
4. Zapis → status `pending` → komunikat „Profil czeka na zatwierdzenie”.
5. Admin zatwierdza → `active`, profil publiczny.
6. **S6 Panel korepetytora**:
   - `Zgłoszenia`: akceptuj / odrzuć,
   - `Grafik`: najbliższe lekcje, oznacz jako zakończoną,
   - `Dostępność`: dodaj/usuń slot,
   - `Profil`: edycja danych i ceny.

**Reguły:**
- korepetytor `pending` nie może przyjmować rezerwacji,
- jeden slot = jedna aktywna rezerwacja (`pending`/`accepted`),
- odrzucenie/anulowanie zwalnia slot,
- nie można usunąć slotu z aktywną rezerwacją.

## 5. Flow 3 — admin: zaufanie i porządek

1. **S7 Admin → Profile**: lista korepetytorów `pending`, podgląd profilu, `Zatwierdź` / `Odrzuć`.
2. **S7 Admin → Opinie**: lista opinii, `Ukryj` / `Przywróć`.
3. **S7 Admin → Działy**: lista działów maturalnych (seed), dodanie/edycja nazwy.

**Reguły:**
- ukryta opinia nie liczy się do średniej,
- odrzucony profil nie jest publiczny, ale konto zostaje,
- admin nie może usunąć użytkownika z aktywną rezerwacją.

## 6. Statusy rezerwacji

```text
pending ──accept──> accepted ──complete──> completed ──review──> (opinia)
   │                   │
   ├──decline──> declined
   ├──cancel───> cancelled
   └──cancel───> cancelled
```

| Status | Kto ustawia | Slot | Widok ucznia | Widok korepetytora |
|---|---|---|---|---|
| `pending` | uczeń | zajęty | „Oczekuje na akceptację” | „Nowe zgłoszenie” |
| `accepted` | korepetytor | zajęty | „Zaakceptowana” | „Zaakceptowana” |
| `declined` | korepetytor | wolny | „Odrzucona” | — |
| `completed` | korepetytor | — | „Zakończona” + opinia | „Zakończona” |
| `cancelled` | uczeń/korepetytor | wolny | „Anulowana” | „Anulowana” |

## 7. Statusy profilu korepetytora

```text
draft ──submit──> pending ──approve──> active
                    └────reject────> rejected (można poprawić i wysłać ponownie)
```

## 8. Reguły opinii

- tylko po `completed`,
- jedna opinia na rezerwację,
- autor widoczny jako imię + inicjał,
- admin może ukryć opinię,
- ukryta opinia nie wchodzi do średniej.

## 9. Nawigacja

**Publiczny navbar:** logo · `Jak to działa` · `Korepetytorzy` · `Dla korepetytorów` · `Zaloguj się` · CTA `Znajdź korepetytora`.

**Uczeń:** logo · `Szukaj` · `Moje lekcje` · avatar (menu: profil, wyloguj).

**Korepetytor:** logo · `Panel` · `Dostępność` · `Profil` · avatar.

**Admin:** logo · `Moderacja` · `Użytkownicy` · `Wyloguj`.

**Stopka:** opis, `Uczniowie`, `Korepetytorzy`, `Kontakt`, `Regulamin`, `Polityka prywatności`.

## 10. Stany brzegowe do zaprojektowania

- brak wyników → EmptyState + `Wyczyść filtry`,
- ładowanie listy → Skeleton,
- błąd walidacji formularza → InlineMessage przy polu,
- slot zajęty → komunikat + odświeżenie SlotPicker,
- brak logowania → modal auth,
- profil `pending` → panel z informacją, bez publicznego linku,
- brak lekcji → EmptyState z CTA,
- brak opinii → EmptyState „Opinie pojawią się po zakończonej lekcji”,
- 404 / 500 → prosta strona z powrotem do S1.

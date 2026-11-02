# Brief projektu — MaturaKorki (robocza nazwa)

## 1. Problem

Maturzysta szukający korepetytora z matematyki traci czas na:
- przeglądanie grup FB i ogłoszeń, gdzie cena i termin ustalane są w DM,
- brak porównywalnych opinii i informacji, czy korepetytor zna **konkretny dział matury**,
- wielodniowe „dogadywanie się” w sprawie terminu.

Korepetytor traci czas na powtarzalne pytania i ręczne zarządzanie grafikiem.

**Cel:** jedno miejsce, w którym uczeń znajdzie korepetytora po dziale, poziomie i cenie, sprawdzi opinie i zarezerwuje termin.

**Pozycjonowanie:** nie kolejny Superprof — wąska specjalizacja: **tylko matematyka do matury**, dopasowanie po działach, poziomie (podstawa/rozszerzenie) i terminie.

## 2. Persony

| Persona | Kim jest | Czego chce |
|---|---|---|
| **Zosia, 18 lat** (primary) | maturzystka, matematyka rozszerzona, cel 70%+ | szybko znaleźć korepetytora od konkretnego działu, z opiniami, w budżecie do ~120 zł/h, online wieczorem |
| **Michał, 24 lata** (secondary) | student/nauczyciel, 5 lat doświadczenia | pokazać profil i terminy, przyjmować zgłoszenia bez DM, mieć 6–8 lekcji/tyg. |
| **Admin** | prowadzący/moderator | zatwierdzać profile, moderować opinie i zgłoszenia |

## 3. Trzy scenariusze

**S1 — „Korepetytor w 3 minuty” (uczeń)**
Zosia wpisuje „matura rozszerzona”, filtruje dział „geometria analityczna” i cenę do 120 zł. Porównuje 3 profile, wybiera Michała, rezerwuje czwartek 18:00, dodaje notatkę („mam problem z wektorami”). Widzi potwierdzenie „oczekuje na akceptację”.

**S2 — „Grafik bez DM” (korepetytor)**
Michał ustawia dostępność na kolejny tydzień. Dostaje zgłoszenie od Zosi, akceptuje je, widzi lekcję w panelu. Po lekcji oznacza ją jako zakończoną — Zosia może wystawić opinię.

**S3 — „Zaufanie i porządek” (admin)**
Nowy korepetytor uzupełnia profil i czeka na zatwierdzenie. Admin aktywuje profil. Pojawia się opinia łamiąca regulamin — admin ją ukrywa. Wszystko bez ręcznego grzebania w bazie.

## 4. MVP (v1)

| Obszar | Funkcje |
|---|---|
| **Konta i role** | rejestracja/logowanie, role: uczeń / korepetytor / admin |
| **Katalog** | lista korepetytorów, filtry: dział, poziom, cena, ocena; sortowanie |
| **Profil korepetytora** | bio, wykształcenie, specjalizacje, cennik, dostępność, opinie |
| **Rezerwacja** | wybór slotu 60 min, notatka, statusy: `pending / accepted / declined / completed / cancelled` |
| **Panel ucznia** | najbliższe i historyczne lekcje, anulowanie, wystawienie opinii |
| **Panel korepetytora** | edycja profilu, dostępność, akceptacja/odrzucenie zgłoszeń, zakończenie lekcji |
| **Panel admina** | zatwierdzanie profili, działy, moderacja opinii |
| **Opinie** | 1–5 gwiazdek + komentarz, tylko po zakończonej lekcji |
| **Dane demo** | 10 korepetytorów, 3 uczniów, kilka rezerwacji i opinii |

**Reguły:**
- jeden slot = jedna aktywna rezerwacja,
- opinia tylko po `completed`,
- profil korepetytora widoczny publicznie po akceptacji admina,
- anulowanie zwalnia slot.

## 5. Poza zakresem v1

Płatności, czat real-time, wideorozmowy, lekcje cykliczne, synchronizacja kalendarza, aplikacja mobilna, wielojęzyczność, weryfikacja dokumentów, zwroty, AI, **tryb stacjonarny**.
Mail, CRON, upload plików i AI wchodzą później — jako osobne inkrementy pod kolejne laboratoria.

## 6. Pięć przepływów → 10 ekranów

| # | Przepływ | Mobile | Web |
|---|---|---|---|
| 1 | Landing + wyszukiwarka (poziom, dział) | 1 | 1 |
| 2 | Wyniki + filtry + karty korepetytorów | 1 | 1 |
| 3 | Profil korepetytora (bio, cennik, terminy, opinie, CTA) | 1 | 1 |
| 4 | Rezerwacja + logowanie/rejestracja + potwierdzenie | 1 | 1 |
| 5 | Panel ucznia (lekcje, statusy, anulowanie, opinia) | 1 | 1 |

Panel korepetytora to **wariant przepływu 5** — dokładamy go jako 11–12 ekran, jeśli starczy czasu.
Minimum z zadania (5 mobile + 5 web) jest spełnione.

## 7. Decyzje zatwierdzone

1. **Tryb:** online only w v1. Stacjonarnie — poza zakresem.
2. **Kto może być korepetytorem:** student lub nauczyciel; profil zatwierdza admin.
3. **Lekcja próbna:** brak w v1.

## 8. Założenia

- język polski, waluta PLN, cena za godzinę,
- poziomy: **podstawa / rozszerzenie**,
- sloty 60-minutowe, bez powtarzalności,
- mobile-first, kontrast i `:focus-visible` pod Lab 3.

## 9. Kryteria sukcesu (demo)

- uczeń przechodzi od wejścia do rezerwacji w ≤ 3 minuty,
- korepetytor obsługuje zgłoszenie w 2 kliknięciach,
- admin moderuje bez dostępu do bazy,
- aplikacja czytelna na 360 px i desktopie,
- seedowane dane sprawiają, że demo nie wygląda pusto.

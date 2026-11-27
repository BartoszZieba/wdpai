# Baza danych MaturaKorki

Schemat i dane demonstracyjne dla Lab 7/8.

Pliki są montowane do `/docker-entrypoint-initdb.d` i uruchamiane przez oficjalny obraz PostgreSQL **tylko przy pierwszym starcie pustego wolumenu**:

1. `001_schema.sql` — tabele, klucze obce, ograniczenia `CHECK`, indeksy, funkcja i trigger `updated_at`.
2. `002_seed.sql` — 6 korepetytorów, działy, terminy, opinie i 4 rezerwacje demonstracyjne w różnych statusach.

## Tabele

| Tabela | Rola |
|---|---|
| `tutors` | profile korepetytorów; `status` = `active` / `pending` / `hidden` |
| `topics` | słownik działów matematyki |
| `tutor_topics` | wiele działów na korepetytora |
| `tutor_slots` | terminy 60-minutowe; `is_available` blokuje zajęty slot |
| `tutor_reviews` | opinie widoczne na profilu |
| `bookings` | rezerwacje; statusy `pending` / `accepted` / `completed` / `cancelled` / `declined` |

## Reset bazy

```bash
docker compose down -v
docker compose up -d --build
```

`down -v` usuwa wolumen `pg-data`; kolejny start odtwarza schemat i seed. Nie używaj tej komendy, jeśli chcesz zachować dane.

## Połączenie

PHP w kontenerze łączy się z hostem `db`, portem `5432`, bazą `wdpai` i użytkownikiem `wdpai_user`. Zmienne są przekazywane w `docker-compose.yaml` jako `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`.

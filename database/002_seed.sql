-- MaturaKorki — dane demonstracyjne (Lab 7/8)
-- Bez danych osobowych i sekretów; e-maile mają domenę example.com.

BEGIN;

INSERT INTO tutors
    (id, name, initials, headline, level, price, rating, reviews_count,
     lessons_count, experience_years, next_slot, bio, education, status)
VALUES
    (1, 'Michał K.', 'MK', 'Korepetytor matematyki', 'Rozszerzenie', 110, 4.9, 23,
     120, 5, 'czw. 18:00',
     'Uczę matematyki od 5 lat. Pomagam maturzystom ogarnąć działy, które sprawiają najwięcej problemów — od funkcji po geometrię analityczną. Na zajęciach rozwiązujemy zadania maturalne i pracujemy nad strategią egzaminu.',
     'Studia matematyczne · 5 lat doświadczenia w nauczaniu.', 'active'),
    (2, 'Anna W.', 'AW', 'Korepetytorka matematyki', 'Podstawa i rozszerzenie', 95, 4.8, 17,
     80, 4, 'dziś 19:00',
     'Tłumaczę matematykę spokojnie i od podstaw. Lubię pracować na zadaniach maturalnych i pokazywać, że probabilistyka oraz ciągi są prostsze, niż wyglądają.',
     'Studia matematyczne · 4 lata doświadczenia w nauczaniu.', 'active'),
    (3, 'Tomasz R.', 'TR', 'Korepetytor matematyki', 'Rozszerzenie', 130, 5.0, 11,
     60, 6, 'pt. 16:30',
     'Specjalizuję się w geometrii i trygonometrii na poziomie rozszerzonym. Pracujemy na zadaniach z arkuszy maturalnych i uczymy się rozpoznawać schematy.',
     'Studia matematyczne · 6 lat doświadczenia w nauczaniu.', 'active'),
    (4, 'Karolina S.', 'KS', 'Korepetytorka matematyki', 'Podstawa', 85, 4.7, 31,
     150, 3, 'wt. 17:00',
     'Pomagam nadrobić podstawy i przygotować się do matury na poziomie podstawowym. Stawiam na zrozumienie krok po kroku i regularne ćwiczenia.',
     'Studia matematyczne · 3 lata doświadczenia w nauczaniu.', 'active'),
    (5, 'Paweł M.', 'PM', 'Korepetytor matematyki', 'Rozszerzenie', 120, 4.6, 14,
     90, 7, 'sob. 10:00',
     'Uczę kombinatoryki i prawdopodobieństwa bez wkuwania schematów. Rozkładamy zadania na małe kroki i sprawdzamy, gdzie naprawdę trzeba uważać.',
     'Studia matematyczne · 7 lat doświadczenia w nauczaniu.', 'active'),
    (6, 'Julia D.', 'JD', 'Korepetytorka matematyki', 'Podstawa i rozszerzenie', 100, 4.9, 28,
     110, 5, 'pon. 18:30',
     'Łączę funkcje i ciągi z zadaniami maturalnymi. Zależy mi, żebyś rozumiał, skąd bierze się wynik, a nie tylko zapamiętywał wzór.',
     'Studia matematyczne · 5 lat doświadczenia w nauczaniu.', 'active');

SELECT setval(pg_get_serial_sequence('tutors', 'id'), (SELECT MAX(id) FROM tutors), TRUE);

INSERT INTO topics (id, name) VALUES
    (1, 'Geometria analityczna'),
    (2, 'Funkcje'),
    (3, 'Trygonometria'),
    (4, 'Prawdopodobieństwo'),
    (5, 'Ciągi'),
    (6, 'Stereometria'),
    (7, 'Równania i nierówności'),
    (8, 'Planimetria'),
    (9, 'Kombinatoryka');

SELECT setval(pg_get_serial_sequence('topics', 'id'), (SELECT MAX(id) FROM topics), TRUE);

INSERT INTO tutor_topics (tutor_id, topic_id, sort_order) VALUES
    (1, 1, 1), (1, 2, 2), (1, 3, 3),
    (2, 4, 1), (2, 5, 2),
    (3, 3, 1), (3, 6, 2),
    (4, 7, 1), (4, 8, 2),
    (5, 9, 1), (5, 4, 2),
    (6, 2, 1), (6, 5, 2);

INSERT INTO tutor_slots (tutor_id, label, sort_order) VALUES
    (1, 'czw. 29.10 18:00', 1), (1, 'pt. 30.10 16:30', 2), (1, 'sob. 31.10 10:00', 3),
    (2, 'dziś 19:00', 1), (2, 'wt. 03.11 17:00', 2), (2, 'sob. 01.11 11:00', 3),
    (3, 'pt. 30.10 16:30', 1), (3, 'pon. 02.11 18:00', 2), (3, 'wt. 03.11 19:00', 3),
    (4, 'wt. 03.11 17:00', 1), (4, 'czw. 29.10 16:00', 2), (4, 'sob. 31.10 09:00', 3),
    (5, 'sob. 31.10 10:00', 1), (5, 'pon. 02.11 17:00', 2), (5, 'śr. 29.10 18:00', 3),
    (6, 'pon. 02.11 18:30', 1), (6, 'pt. 30.10 17:00', 2), (6, 'sob. 31.10 12:00', 3);

INSERT INTO tutor_reviews
    (tutor_id, author, rating, reviewed_at_label, comment, sort_order)
VALUES
    (1, 'Zosia', 5.0, '2 tygodnie temu',
     'Dzięki Michałowi ogarnęłam wektory przed maturą. Konkretnie, bez lania wody.', 1),
    (1, 'Kuba', 5.0, 'miesiąc temu',
     'Świetne tłumaczenie zadań z funkcji. Dużo przykładów maturalnych.', 2),
    (1, 'Ola', 4.0, '2 miesiące temu',
     'Solidne zajęcia, ale warto wcześniej wysłać temat.', 3),
    (2, 'Marta', 5.0, '3 tygodnie temu',
     'Bardzo cierpliwe tłumaczenie prawdopodobieństwa. Wreszcie rozumiem zadania z kulami.', 1),
    (2, 'Piotr', 4.5, '2 miesiące temu',
     'Dobre przygotowanie do poprawki. Dużo zadań i jasny plan.', 2),
    (3, 'Kamil', 5.0, 'miesiąc temu',
     'Stereometria w końcu stała się przewidywalna. Bardzo konkretne zajęcia.', 1),
    (4, 'Ola', 5.0, 'tydzień temu',
     'Wreszcie ogarniam równania. Karolina wszystko spokojnie tłumaczy.', 1),
    (4, 'Michał', 4.0, '3 miesiące temu',
     'Solidne podstawy i dużo ćwiczeń.', 2),
    (5, 'Jan', 4.5, '2 tygodnie temu',
     'Kombinatoryka przestała być czarną magią. Dobrze wytłumaczone schematy.', 1),
    (6, 'Zofia', 5.0, 'miesiąc temu',
     'Funkcje w końcu mają sens. Julia świetnie tłumaczy przekształcenia.', 1),
    (6, 'Adam', 4.5, '2 miesiące temu',
     'Dobre zajęcia, dużo przykładów i spokojne tempo.', 2);

-- Rezerwacje demonstracyjne pokazują wszystkie statusy w panelu.
INSERT INTO bookings
    (id, tutor_id, topic, price, slot, student_name, email, note, status, created_at)
VALUES
    ('BK-DEMO-001', 1, 'Geometria analityczna', 110, 'czw. 29.10 18:00',
     'Zosia Nowak', 'zosia@example.com', 'Mam problem z wektorami.', 'pending', '2026-10-20 10:00:00+02'),
    ('BK-DEMO-002', 2, 'Prawdopodobieństwo', 95, 'wt. 03.11 17:00',
     'Kuba Lis', 'kuba@example.com', '', 'accepted', '2026-10-21 12:30:00+02'),
    ('BK-DEMO-003', 3, 'Trygonometria', 130, 'wt. 20.10 17:00',
     'Ola Kot', 'ola@example.com', 'Proszę o zadania z arkuszy.', 'completed', '2026-10-10 09:15:00+02'),
    ('BK-DEMO-004', 4, 'Planimetria', 85, 'czw. 15.10 18:00',
     'Michał Dudek', 'michal@example.com', '', 'cancelled', '2026-10-01 18:40:00+02');

-- Terminy z aktywnymi rezerwacjami demonstracyjnymi nie są już wolne.
UPDATE tutor_slots SET is_available = FALSE
WHERE (tutor_id = 1 AND label = 'czw. 29.10 18:00')
   OR (tutor_id = 2 AND label = 'wt. 03.11 17:00');

COMMIT;

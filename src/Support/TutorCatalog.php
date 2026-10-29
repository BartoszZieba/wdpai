<?php

declare(strict_types=1);

namespace App\Support;

final class TutorCatalog
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Michał K.',
                'initials' => 'MK',
                'headline' => 'Korepetytor matematyki',
                'level' => 'Rozszerzenie',
                'topics' => ['Geometria analityczna', 'Funkcje', 'Trygonometria'],
                'rating' => 4.9,
                'reviews_count' => 23,
                'reviews_label' => '23 opinie',
                'price' => 110,
                'lessons' => 120,
                'experience' => 5,
                'next_slot' => 'czw. 18:00',
                'bio' => 'Uczę matematyki od 5 lat. Pomagam maturzystom ogarnąć działy, które sprawiają najwięcej problemów — od funkcji po geometrię analityczną. Na zajęciach rozwiązujemy zadania maturalne i pracujemy nad strategią egzaminu.',
                'education' => 'Studia matematyczne · 5 lat doświadczenia w nauczaniu.',
                'slots' => ['czw. 29.10 18:00', 'pt. 30.10 16:30', 'sob. 31.10 10:00'],
                'reviews' => [
                    [
                        'author' => 'Zosia',
                        'rating' => 5.0,
                        'date' => '2 tygodnie temu',
                        'comment' => 'Dzięki Michałowi ogarnęłam wektory przed maturą. Konkretnie, bez lania wody.',
                    ],
                    [
                        'author' => 'Kuba',
                        'rating' => 5.0,
                        'date' => 'miesiąc temu',
                        'comment' => 'Świetne tłumaczenie zadań z funkcji. Dużo przykładów maturalnych.',
                    ],
                    [
                        'author' => 'Ola',
                        'rating' => 4.0,
                        'date' => '2 miesiące temu',
                        'comment' => 'Solidne zajęcia, ale warto wcześniej wysłać temat.',
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Anna W.',
                'initials' => 'AW',
                'headline' => 'Korepetytorka matematyki',
                'level' => 'Podstawa i rozszerzenie',
                'topics' => ['Prawdopodobieństwo', 'Ciągi'],
                'rating' => 4.8,
                'reviews_count' => 17,
                'reviews_label' => '17 opinii',
                'price' => 95,
                'lessons' => 80,
                'experience' => 4,
                'next_slot' => 'dziś 19:00',
                'bio' => 'Tłumaczę matematykę spokojnie i od podstaw. Lubię pracować na zadaniach maturalnych i pokazywać, że probabilistyka oraz ciągi są prostsze, niż wyglądają.',
                'education' => 'Studia matematyczne · 4 lata doświadczenia w nauczaniu.',
                'slots' => ['dziś 19:00', 'wt. 03.11 17:00', 'sob. 01.11 11:00'],
                'reviews' => [
                    [
                        'author' => 'Marta',
                        'rating' => 5.0,
                        'date' => '3 tygodnie temu',
                        'comment' => 'Bardzo cierpliwe tłumaczenie prawdopodobieństwa. Wreszcie rozumiem zadania z kulami.',
                    ],
                    [
                        'author' => 'Piotr',
                        'rating' => 4.5,
                        'date' => '2 miesiące temu',
                        'comment' => 'Dobre przygotowanie do poprawki. Dużo zadań i jasny plan.',
                    ],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Tomasz R.',
                'initials' => 'TR',
                'headline' => 'Korepetytor matematyki',
                'level' => 'Rozszerzenie',
                'topics' => ['Trygonometria', 'Stereometria'],
                'rating' => 5.0,
                'reviews_count' => 11,
                'reviews_label' => '11 opinii',
                'price' => 130,
                'lessons' => 60,
                'experience' => 6,
                'next_slot' => 'pt. 16:30',
                'bio' => 'Specjalizuję się w geometrii i trygonometrii na poziomie rozszerzonym. Pracujemy na zadaniach z arkuszy maturalnych i uczymy się rozpoznawać schematy.',
                'education' => 'Studia matematyczne · 6 lat doświadczenia w nauczaniu.',
                'slots' => ['pt. 30.10 16:30', 'pon. 02.11 18:00', 'wt. 03.11 19:00'],
                'reviews' => [
                    [
                        'author' => 'Kamil',
                        'rating' => 5.0,
                        'date' => 'miesiąc temu',
                        'comment' => 'Stereometria w końcu stała się przewidywalna. Bardzo konkretne zajęcia.',
                    ],
                ],
            ],
            [
                'id' => 4,
                'name' => 'Karolina S.',
                'initials' => 'KS',
                'headline' => 'Korepetytorka matematyki',
                'level' => 'Podstawa',
                'topics' => ['Równania i nierówności', 'Planimetria'],
                'rating' => 4.7,
                'reviews_count' => 31,
                'reviews_label' => '31 opinii',
                'price' => 85,
                'lessons' => 150,
                'experience' => 3,
                'next_slot' => 'wt. 17:00',
                'bio' => 'Pomagam nadrobić podstawy i przygotować się do matury na poziomie podstawowym. Stawiam na zrozumienie krok po kroku i regularne ćwiczenia.',
                'education' => 'Studia matematyczne · 3 lata doświadczenia w nauczaniu.',
                'slots' => ['wt. 03.11 17:00', 'czw. 29.10 16:00', 'sob. 31.10 09:00'],
                'reviews' => [
                    [
                        'author' => 'Ola',
                        'rating' => 5.0,
                        'date' => 'tydzień temu',
                        'comment' => 'Wreszcie ogarniam równania. Karolina wszystko spokojnie tłumaczy.',
                    ],
                    [
                        'author' => 'Michał',
                        'rating' => 4.0,
                        'date' => '3 miesiące temu',
                        'comment' => 'Solidne podstawy i dużo ćwiczeń.',
                    ],
                ],
            ],
            [
                'id' => 5,
                'name' => 'Paweł M.',
                'initials' => 'PM',
                'headline' => 'Korepetytor matematyki',
                'level' => 'Rozszerzenie',
                'topics' => ['Kombinatoryka', 'Prawdopodobieństwo'],
                'rating' => 4.6,
                'reviews_count' => 14,
                'reviews_label' => '14 opinii',
                'price' => 120,
                'lessons' => 90,
                'experience' => 7,
                'next_slot' => 'sob. 10:00',
                'bio' => 'Uczę kombinatoryki i prawdopodobieństwa bez wkuwania schematów. Rozkładamy zadania na małe kroki i sprawdzamy, gdzie naprawdę trzeba uważać.',
                'education' => 'Studia matematyczne · 7 lat doświadczenia w nauczaniu.',
                'slots' => ['sob. 31.10 10:00', 'pon. 02.11 17:00', 'śr. 29.10 18:00'],
                'reviews' => [
                    [
                        'author' => 'Jan',
                        'rating' => 4.5,
                        'date' => '2 tygodnie temu',
                        'comment' => 'Kombinatoryka przestała być czarną magią. Dobrze wytłumaczone schematy.',
                    ],
                ],
            ],
            [
                'id' => 6,
                'name' => 'Julia D.',
                'initials' => 'JD',
                'headline' => 'Korepetytorka matematyki',
                'level' => 'Podstawa i rozszerzenie',
                'topics' => ['Funkcje', 'Ciągi'],
                'rating' => 4.9,
                'reviews_count' => 28,
                'reviews_label' => '28 opinii',
                'price' => 100,
                'lessons' => 110,
                'experience' => 5,
                'next_slot' => 'pon. 18:30',
                'bio' => 'Łączę funkcje i ciągi z zadaniami maturalnymi. Zależy mi, żebyś rozumiał, skąd bierze się wynik, a nie tylko zapamiętywał wzór.',
                'education' => 'Studia matematyczne · 5 lat doświadczenia w nauczaniu.',
                'slots' => ['pon. 02.11 18:30', 'pt. 30.10 17:00', 'sob. 31.10 12:00'],
                'reviews' => [
                    [
                        'author' => 'Zofia',
                        'rating' => 5.0,
                        'date' => 'miesiąc temu',
                        'comment' => 'Funkcje w końcu mają sens. Julia świetnie tłumaczy przekształcenia.',
                    ],
                    [
                        'author' => 'Adam',
                        'rating' => 4.5,
                        'date' => '2 miesiące temu',
                        'comment' => 'Dobre zajęcia, dużo przykładów i spokojne tempo.',
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $tutor) {
            if ($tutor['id'] === $id) {
                return $tutor;
            }
        }

        return null;
    }

    /**
     * @return array<int, string>
     */
    public static function topics(): array
    {
        $topics = [];

        foreach (self::all() as $tutor) {
            foreach ($tutor['topics'] as $topic) {
                if (!in_array($topic, $topics, true)) {
                    $topics[] = $topic;
                }
            }
        }

        return $topics;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function filter(string $level, string $topic): array
    {
        $level = trim($level);
        $topic = trim($topic);

        return array_values(array_filter(
            self::all(),
            static function (array $tutor) use ($level, $topic): bool {
                if ($level !== '' && stripos($tutor['level'], $level) === false) {
                    return false;
                }

                if ($topic !== '' && !in_array($topic, $tutor['topics'], true)) {
                    return false;
                }

                return true;
            },
        ));
    }
}

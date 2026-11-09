<?php

declare(strict_types=1);

namespace App\Controller;

use App\Support\BookingStore;

final class DashboardController extends AppController
{
    public function index(): void
    {
        $tab = (string) ($_GET['tab'] ?? 'upcoming');

        if (!in_array($tab, ['upcoming', 'history', 'reviews'], true)) {
            $tab = 'upcoming';
        }

        $lessons = $this->lessons();
        $upcoming = array_values(array_filter(
            $lessons,
            static fn (array $lesson): bool => in_array($lesson['status'], ['pending', 'accepted'], true),
        ));
        $history = array_values(array_filter(
            $lessons,
            static fn (array $lesson): bool => in_array($lesson['status'], ['completed', 'cancelled', 'declined'], true),
        ));
        $reviews = array_values(array_filter(
            $lessons,
            static fn (array $lesson): bool => $lesson['status'] === 'completed',
        ));

        $visibleLessons = match ($tab) {
            'history' => $history,
            'reviews' => $reviews,
            default => $upcoming,
        };

        $this->render('dashboard', [
            'pageTitle' => 'Moje lekcje — MaturaKorki',
            'headerVariant' => 'app',
            'footerVariant' => 'minimal',
            'showBackToTop' => false,
            'tab' => $tab,
            'lessons' => $visibleLessons,
            'reviewLesson' => $reviews[0] ?? null,
            'counts' => [
                'upcoming' => count($upcoming),
                'history' => count($history),
                'reviews' => count($reviews),
            ],
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function lessons(): array
    {
        $lessons = [];

        foreach (array_reverse(BookingStore::all()) as $booking) {
            $slot = (string) ($booking['slot'] ?? '');
            $date = $slot;
            $time = '';

            if (preg_match('/^(.*?)\s+(\d{2}:\d{2})$/', $slot, $matches) === 1) {
                $date = $matches[1];
                $time = $matches[2];
            }

            $lessons[] = [
                'id' => (string) ($booking['id'] ?? 'BK'),
                'date' => $date,
                'time' => $time,
                'tutor' => (string) ($booking['tutor_name'] ?? 'Korepetytor'),
                'topic' => (string) ($booking['topic'] ?? 'Korepetycje z matematyki'),
                'price' => (int) ($booking['price'] ?? 0),
                'status' => 'pending',
                'status_label' => 'Oczekuje na akceptację',
                'can_cancel' => true,
                'can_review' => false,
            ];
        }

        return array_merge($lessons, $this->seedLessons());
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function seedLessons(): array
    {
        return [
            [
                'id' => 1,
                'date' => 'czw. 29.10',
                'time' => '18:00',
                'tutor' => 'Michał K.',
                'topic' => 'Geometria analityczna',
                'price' => 110,
                'status' => 'pending',
                'status_label' => 'Oczekuje na akceptację',
                'can_cancel' => true,
                'can_review' => false,
            ],
            [
                'id' => 2,
                'date' => 'pt. 30.10',
                'time' => '19:00',
                'tutor' => 'Anna W.',
                'topic' => 'Prawdopodobieństwo',
                'price' => 95,
                'status' => 'accepted',
                'status_label' => 'Zaakceptowana',
                'can_cancel' => true,
                'can_review' => false,
            ],
            [
                'id' => 3,
                'date' => 'wt. 20.10',
                'time' => '17:00',
                'tutor' => 'Tomasz R.',
                'topic' => 'Trygonometria',
                'price' => 130,
                'status' => 'completed',
                'status_label' => 'Zakończona',
                'can_cancel' => false,
                'can_review' => true,
            ],
            [
                'id' => 4,
                'date' => 'czw. 15.10',
                'time' => '18:00',
                'tutor' => 'Karolina S.',
                'topic' => 'Planimetria',
                'price' => 85,
                'status' => 'cancelled',
                'status_label' => 'Anulowana',
                'can_cancel' => false,
                'can_review' => false,
            ],
        ];
    }
}

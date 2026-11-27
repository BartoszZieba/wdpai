<?php

declare(strict_types=1);

namespace App\Controller;

use App\Models\Booking;
use App\Repository\BookingRepository;

final class DashboardController extends AppController
{
    public function __construct(private readonly BookingRepository $bookings)
    {
    }

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
     * @return list<array<string, int|string|bool>>
     */
    private function lessons(): array
    {
        return array_map(
            static fn (Booking $booking): array => $booking->toDashboardArray(),
            $this->bookings->findAll(),
        );
    }
}

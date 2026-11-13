<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Booking;

/**
 * Tymczasowy magazyn rezerwacji w sesji.
 *
 * W Lab 7 zostanie zastąpiony repozytorium PostgreSQL.
 */
final class BookingStore
{
    public static function add(Booking $booking): void
    {
        $bookings = self::all();
        $bookings[] = $booking->toArray();

        Session::set('bookings', $bookings);
        Session::set('last_booking', $booking->toArray());
    }

    /**
     * @return array<int, array<string, int|string>>
     */
    public static function all(): array
    {
        $bookings = Session::get('bookings', []);

        return is_array($bookings) ? $bookings : [];
    }

    /**
     * @return array<string, int|string>|null
     */
    public static function latest(): ?array
    {
        $booking = Session::get('last_booking');

        return is_array($booking) ? $booking : null;
    }
}

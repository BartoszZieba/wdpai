<?php

declare(strict_types=1);

namespace App\Controller;

use App\Support\TutorCatalog;

final class BookingController extends AppController
{
    public function index(): void
    {
        $tutorId = (int) ($_GET['tutor'] ?? 1);
        $tutor = TutorCatalog::find($tutorId) ?? TutorCatalog::find(1);

        if ($tutor === null) {
            http_response_code(404);
            $this->render('not-found', [
                'pageTitle' => 'Nie znaleziono korepetytora — MaturaKorki',
            ]);

            return;
        }

        $selectedSlot = trim((string) ($_GET['slot'] ?? ''));
        $note = trim((string) ($_GET['note'] ?? ''));

        $this->render('booking', [
            'pageTitle' => 'Rezerwacja lekcji — MaturaKorki',
            'tutor' => $tutor,
            'selectedSlot' => $selectedSlot,
            'note' => $note,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Models\Booking;
use App\Support\BookingStore;
use App\Support\Session;
use App\Support\TutorCatalog;
use App\Validation\BookingValidator;

final class BookingController extends AppController
{
    public function index(): void
    {
        $tutorId = (int) ($_GET['tutor'] ?? 1);
        $tutor = TutorCatalog::find($tutorId);

        if ($tutor === null) {
            $this->renderNotFound();

            return;
        }

        $old = Session::pull('old', []);
        $errors = Session::pull('errors', []);
        $old = is_array($old) ? $old : [];
        $errors = is_array($errors) ? $errors : [];

        $selectedSlot = $this->stringValue($old, 'slot');
        if ($selectedSlot === '') {
            $selectedSlot = $this->stringValue($_GET, 'slot');
        }

        $note = $this->stringValue($old, 'note');
        if ($note === '') {
            $note = $this->stringValue($_GET, 'note');
        }

        $this->render('booking', [
            'pageTitle' => 'Rezerwacja lekcji — MaturaKorki',
            'headerVariant' => 'minimal',
            'footerVariant' => 'minimal',
            'showBackToTop' => false,
            'tutor' => $tutor,
            'selectedSlot' => $selectedSlot,
            'note' => $note,
            'name' => $this->stringValue($old, 'name'),
            'email' => $this->stringValue($old, 'email'),
            'consent' => $this->stringValue($old, 'consent') === '1',
            'errors' => $errors,
            'csrfToken' => Session::csrfToken(),
        ]);
    }

    public function store(): void
    {
        $tutorId = (int) ($_POST['tutor'] ?? 0);
        $tutor = TutorCatalog::find($tutorId);

        if ($tutor === null) {
            $this->renderNotFound();

            return;
        }

        $validator = new BookingValidator();
        $data = $validator->normalize($_POST);

        if (!Session::verifyCsrf($_POST['csrf_token'] ?? null)) {
            Session::flash('errors', [
                'csrf' => 'Sesja wygasła. Odśwież stronę i wyślij formularz ponownie.',
            ]);
            Session::flash('old', $data);

            $this->redirect('/booking?tutor=' . $tutorId);
        }

        $errors = $validator->validate($data, $tutor);

        if ($errors !== []) {
            Session::flash('errors', $errors);
            Session::flash('old', $data);

            $this->redirect('/booking?tutor=' . $tutorId);
        }

        $booking = new Booking(
            id: 'BK-' . strtoupper(bin2hex(random_bytes(3))),
            tutorId: (int) $tutor['id'],
            tutorName: (string) $tutor['name'],
            topic: (string) ($tutor['topics'][0] ?? 'Korepetycje z matematyki'),
            price: (int) $tutor['price'],
            slot: $data['slot'],
            studentName: $data['name'],
            email: $data['email'],
            note: $data['note'],
            status: 'pending',
            createdAt: date('Y-m-d H:i'),
        );

        BookingStore::add($booking);
        $this->redirect('/booking/success');
    }

    public function success(): void
    {
        $booking = BookingStore::latest();

        if ($booking === null) {
            $this->redirect('/tutors');
        }

        $this->render('booking-success', [
            'pageTitle' => 'Zgłoszenie wysłane — MaturaKorki',
            'headerVariant' => 'minimal',
            'footerVariant' => 'minimal',
            'showBackToTop' => false,
            'booking' => $booking,
        ]);
    }

    private function renderNotFound(): void
    {
        http_response_code(404);
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono korepetytora — MaturaKorki',
        ]);
    }

    /**
     * @param array<string, mixed> $source
     */
    private function stringValue(array $source, string $key): string
    {
        $value = $source[$key] ?? '';

        return is_string($value) ? trim($value) : '';
    }
}

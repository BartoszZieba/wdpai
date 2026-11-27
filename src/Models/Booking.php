<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Encja rezerwacji odtwarzana z tabeli bookings.
 */
final class Booking
{
    public function __construct(
        public readonly string $id,
        public readonly int $tutorId,
        public readonly string $tutorName,
        public readonly string $topic,
        public readonly int $price,
        public readonly string $slot,
        public readonly string $studentName,
        public readonly string $email,
        public readonly string $note,
        public readonly string $status,
        public readonly string $createdAt,
    ) {
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending' => 'Oczekuje na akceptację',
            'accepted' => 'Zaakceptowana',
            'completed' => 'Zakończona',
            'cancelled' => 'Anulowana',
            'declined' => 'Odrzucona',
            default => $this->status,
        };
    }

    public function canCancel(): bool
    {
        return in_array($this->status, ['pending', 'accepted'], true);
    }

    public function canReview(): bool
    {
        return $this->status === 'completed';
    }

    public function slotDate(): string
    {
        if (preg_match('/^(.*?)\s+(\d{2}:\d{2})$/', $this->slot, $matches) === 1) {
            return $matches[1];
        }

        return $this->slot;
    }

    public function slotTime(): string
    {
        if (preg_match('/^(.*?)\s+(\d{2}:\d{2})$/', $this->slot, $matches) === 1) {
            return $matches[2];
        }

        return '';
    }

    /**
     * Format oczekiwany przez widok panelu ucznia.
     *
     * @return array<string, int|string|bool>
     */
    public function toDashboardArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->slotDate(),
            'time' => $this->slotTime(),
            'tutor' => $this->tutorName,
            'topic' => $this->topic,
            'price' => $this->price,
            'status' => $this->status,
            'status_label' => $this->statusLabel(),
            'can_cancel' => $this->canCancel(),
            'can_review' => $this->canReview(),
        ];
    }

    /**
     * @return array<string, int|string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tutor_id' => $this->tutorId,
            'tutor_name' => $this->tutorName,
            'topic' => $this->topic,
            'price' => $this->price,
            'slot' => $this->slot,
            'name' => $this->studentName,
            'email' => $this->email,
            'note' => $this->note,
            'status' => $this->status,
            'created_at' => $this->createdAt,
        ];
    }
}

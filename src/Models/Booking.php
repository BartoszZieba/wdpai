<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Rezerwacja w pamięci sesji.
 *
 * W Lab 7/modelu docelowym ten obiekt będzie odtwarzany z wiersza PostgreSQL.
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

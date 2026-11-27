<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\SlotUnavailableException;
use App\Models\Booking;
use PDO;

/**
 * Repozytorium rezerwacji.
 *
 * Zapis rezerwacji blokuje wybrany termin w tutor_slots w tej samej
 * transakcji, dzięki czemu dwa równoległe żądania nie zajmą tego
 * samego terminu.
 */
final class BookingRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    public function save(Booking $booking): void
    {
        $this->connection->beginTransaction();

        try {
            $slot = $this->connection->prepare(
                'SELECT id
                 FROM tutor_slots
                 WHERE tutor_id = :tutor_id AND label = :label AND is_available = TRUE
                 FOR UPDATE',
            );
            $slot->execute([
                'tutor_id' => $booking->tutorId,
                'label' => $booking->slot,
            ]);
            $slotId = $slot->fetchColumn();

            if ($slotId === false) {
                throw new SlotUnavailableException('Ten termin został właśnie zajęty. Wybierz inny.');
            }

            $this->connection->prepare(
                'UPDATE tutor_slots SET is_available = FALSE WHERE id = :id',
            )->execute(['id' => (int) $slotId]);

            $statement = $this->connection->prepare(
                'INSERT INTO bookings
                    (id, tutor_id, topic, price, slot, student_name, email, note, status, created_at)
                 VALUES
                    (:id, :tutor_id, :topic, :price, :slot, :student_name, :email, :note, :status, :created_at)',
            );
            $statement->execute([
                'id' => $booking->id,
                'tutor_id' => $booking->tutorId,
                'topic' => $booking->topic,
                'price' => $booking->price,
                'slot' => $booking->slot,
                'student_name' => $booking->studentName,
                'email' => $booking->email,
                'note' => $booking->note,
                'status' => $booking->status,
                'created_at' => $booking->createdAt,
            ]);

            $this->connection->commit();
        } catch (\Throwable $exception) {
            if ($this->connection->inTransaction()) {
                $this->connection->rollBack();
            }

            throw $exception;
        }
    }

    public function create(Booking $booking): void
    {
        $this->save($booking);
    }

    public function find(string $id): ?Booking
    {
        $statement = $this->connection->prepare($this->selectSql() . ' WHERE b.id = :id');
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        return $row === false ? null : $this->mapRow($row);
    }

    /**
     * @return list<Booking>
     */
    public function findAll(): array
    {
        $statement = $this->connection->query(
            $this->selectSql() . ' ORDER BY b.created_at DESC, b.id DESC',
        );

        return array_map(
            fn (array $row): Booking => $this->mapRow($row),
            $statement->fetchAll(),
        );
    }

    /**
     * @return list<Booking>
     */
    public function all(): array
    {
        return $this->findAll();
    }

    public function latest(): ?Booking
    {
        $statement = $this->connection->query(
            $this->selectSql() . ' ORDER BY b.created_at DESC, b.id DESC LIMIT 1',
        );
        $row = $statement->fetch();

        return $row === false ? null : $this->mapRow($row);
    }

    private function selectSql(): string
    {
        return 'SELECT b.id, b.tutor_id, b.topic, b.price, b.slot,
                       b.student_name, b.email, b.note, b.status, b.created_at,
                       t.name AS tutor_name
                FROM bookings b
                JOIN tutors t ON t.id = b.tutor_id';
    }

    /**
     * @param array<string, mixed> $row
     */
    private function mapRow(array $row): Booking
    {
        return new Booking(
            id: (string) $row['id'],
            tutorId: (int) $row['tutor_id'],
            tutorName: (string) $row['tutor_name'],
            topic: (string) $row['topic'],
            price: (int) $row['price'],
            slot: (string) $row['slot'],
            studentName: (string) $row['student_name'],
            email: (string) $row['email'],
            note: (string) $row['note'],
            status: (string) $row['status'],
            createdAt: substr((string) $row['created_at'], 0, 16),
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Tutor;
use PDO;

/**
 * Dostęp do danych korepetytorów.
 *
 * SQL pozostaje w repozytorium; kontrolery otrzymują gotowe encje Tutor.
 */
final class TutorRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    /**
     * @return list<Tutor>
     */
    public function findAll(string $level = '', string $topic = ''): array
    {
        $sql = "SELECT t.* FROM tutors t WHERE t.status = 'active'";
        $parameters = [];

        if ($level !== '') {
            $sql .= ' AND t.level ILIKE :level';
            $parameters['level'] = '%' . $level . '%';
        }

        if ($topic !== '') {
            $sql .= ' AND EXISTS (
                SELECT 1
                FROM tutor_topics tt
                JOIN topics tp ON tp.id = tt.topic_id
                WHERE tt.tutor_id = t.id AND tp.name = :topic
            )';
            $parameters['topic'] = $topic;
        }

        $sql .= ' ORDER BY t.id';

        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $this->hydrate($statement->fetchAll());
    }

    public function find(int $id): ?Tutor
    {
        $statement = $this->connection->prepare(
            "SELECT t.* FROM tutors t WHERE t.id = :id AND t.status = 'active'",
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->hydrate([$row])[0] ?? null;
    }

    /**
     * @return list<string>
     */
    public function topics(): array
    {
        $statement = $this->connection->query('SELECT name FROM topics ORDER BY name');

        return array_map(
            static fn (array $row): string => (string) $row['name'],
            $statement->fetchAll(),
        );
    }

    /**
     * Insert encji. Relacje topics/slots są zarządzane osobno.
     */
    public function save(Tutor $tutor): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO tutors
                (name, initials, headline, level, price, rating, reviews_count,
                 lessons_count, experience_years, next_slot, bio, education, status)
             VALUES
                (:name, :initials, :headline, :level, :price, :rating, :reviews_count,
                 :lessons_count, :experience_years, :next_slot, :bio, :education, :status)
             RETURNING id',
        );

        $statement->execute($this->parameters($tutor));

        return (int) $statement->fetchColumn();
    }

    public function update(Tutor $tutor): void
    {
        if ($tutor->id <= 0) {
            throw new \InvalidArgumentException('Nie można zaktualizować korepetytora bez ID.');
        }

        $statement = $this->connection->prepare(
            'UPDATE tutors SET
                name = :name,
                initials = :initials,
                headline = :headline,
                level = :level,
                price = :price,
                rating = :rating,
                reviews_count = :reviews_count,
                lessons_count = :lessons_count,
                experience_years = :experience_years,
                next_slot = :next_slot,
                bio = :bio,
                education = :education,
                status = :status
             WHERE id = :id',
        );

        $statement->execute($this->parameters($tutor) + ['id' => $tutor->id]);
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare('DELETE FROM tutors WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    /**
     * @return array<string, mixed>
     */
    private function parameters(Tutor $tutor): array
    {
        return [
            'name' => $tutor->name,
            'initials' => $tutor->initials,
            'headline' => $tutor->headline,
            'level' => $tutor->level,
            'price' => $tutor->price,
            'rating' => $tutor->rating,
            'reviews_count' => $tutor->reviewsCount,
            'lessons_count' => $tutor->lessons,
            'experience_years' => $tutor->experience,
            'next_slot' => $tutor->nextSlot,
            'bio' => $tutor->bio,
            'education' => $tutor->education,
            'status' => $tutor->status,
        ];
    }

    /**
     * @param list<array<string, mixed>> $rows
     * @return list<Tutor>
     */
    private function hydrate(array $rows): array
    {
        if ($rows === []) {
            return [];
        }

        $ids = array_map(
            static fn (array $row): int => (int) $row['id'],
            $rows,
        );

        $topics = $this->topicsByTutor($ids);
        $slots = $this->slotsByTutor($ids);
        $reviews = $this->reviewsByTutor($ids);

        return array_map(
            fn (array $row): Tutor => $this->mapRow(
                $row,
                $topics[(int) $row['id']] ?? [],
                $slots[(int) $row['id']] ?? [],
                $reviews[(int) $row['id']] ?? [],
            ),
            $rows,
        );
    }

    /**
     * @param array<string, mixed> $row
     * @param list<string> $topics
     * @param list<string> $slots
     * @param list<array{author: string, rating: float, date: string, comment: string}> $reviews
     */
    private function mapRow(array $row, array $topics, array $slots, array $reviews): Tutor
    {
        return new Tutor(
            id: (int) $row['id'],
            name: (string) $row['name'],
            initials: (string) $row['initials'],
            headline: (string) $row['headline'],
            level: (string) $row['level'],
            price: (int) $row['price'],
            rating: (float) $row['rating'],
            reviewsCount: (int) $row['reviews_count'],
            lessons: (int) $row['lessons_count'],
            experience: (int) $row['experience_years'],
            nextSlot: $slots[0] ?? (string) $row['next_slot'],
            bio: (string) $row['bio'],
            education: (string) $row['education'],
            status: (string) $row['status'],
            topics: $topics,
            slots: $slots,
            reviews: $reviews,
        );
    }

    /**
     * @param list<int> $ids
     * @return array<int, list<string>>
     */
    private function topicsByTutor(array $ids): array
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $statement = $this->connection->prepare(
            "SELECT tt.tutor_id, tp.name
             FROM tutor_topics tt
             JOIN topics tp ON tp.id = tt.topic_id
             WHERE tt.tutor_id IN ($placeholders)
             ORDER BY tt.tutor_id, tt.sort_order, tp.name",
        );
        $statement->execute($ids);

        $result = [];

        foreach ($statement->fetchAll() as $row) {
            $result[(int) $row['tutor_id']][] = (string) $row['name'];
        }

        return $result;
    }

    /**
     * @param list<int> $ids
     * @return array<int, list<string>>
     */
    private function slotsByTutor(array $ids): array
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $statement = $this->connection->prepare(
            "SELECT tutor_id, label
             FROM tutor_slots
             WHERE tutor_id IN ($placeholders) AND is_available = TRUE
             ORDER BY tutor_id, sort_order, id",
        );
        $statement->execute($ids);

        $result = [];

        foreach ($statement->fetchAll() as $row) {
            $result[(int) $row['tutor_id']][] = (string) $row['label'];
        }

        return $result;
    }

    /**
     * @param list<int> $ids
     * @return array<int, list<array{author: string, rating: float, date: string, comment: string}>>
     */
    private function reviewsByTutor(array $ids): array
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $statement = $this->connection->prepare(
            "SELECT tutor_id, author, rating, reviewed_at_label, comment
             FROM tutor_reviews
             WHERE tutor_id IN ($placeholders) AND is_visible = TRUE
             ORDER BY tutor_id, sort_order, id",
        );
        $statement->execute($ids);

        $result = [];

        foreach ($statement->fetchAll() as $row) {
            $result[(int) $row['tutor_id']][] = [
                'author' => (string) $row['author'],
                'rating' => (float) $row['rating'],
                'date' => (string) $row['reviewed_at_label'],
                'comment' => (string) $row['comment'],
            ];
        }

        return $result;
    }
}

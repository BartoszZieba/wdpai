<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Encja korepetytora odtwarzana z wiersza PostgreSQL.
 *
 * Repozytorium mapuje wiersz na ten obiekt, a widoki korzystają
 * z gotowych, typowanych właściwości.
 */
final class Tutor
{
    /**
     * @param list<string> $topics
     * @param list<string> $slots
     * @param list<array{author: string, rating: float, date: string, comment: string}> $reviews
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $initials,
        public readonly string $headline,
        public readonly string $level,
        public readonly int $price,
        public readonly float $rating,
        public readonly int $reviewsCount,
        public readonly int $lessons,
        public readonly int $experience,
        public readonly string $nextSlot,
        public readonly string $bio,
        public readonly string $education,
        public readonly string $status,
        public readonly array $topics,
        public readonly array $slots,
        public readonly array $reviews,
    ) {
    }

    public function reviewsLabel(): string
    {
        $count = $this->reviewsCount;

        if ($count === 1) {
            return '1 opinia';
        }

        $lastDigit = $count % 10;
        $lastTwo = $count % 100;

        if ($lastDigit >= 2 && $lastDigit <= 4 && ($lastTwo < 12 || $lastTwo > 14)) {
            return $count . ' opinie';
        }

        return $count . ' opinii';
    }

    /**
     * Pomocnicza reprezentacja dla miejsc, które nadal pracują na tablicach.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'initials' => $this->initials,
            'headline' => $this->headline,
            'level' => $this->level,
            'price' => $this->price,
            'rating' => $this->rating,
            'reviews_count' => $this->reviewsCount,
            'reviews_label' => $this->reviewsLabel(),
            'lessons' => $this->lessons,
            'experience' => $this->experience,
            'next_slot' => $this->nextSlot,
            'bio' => $this->bio,
            'education' => $this->education,
            'status' => $this->status,
            'topics' => $this->topics,
            'slots' => $this->slots,
            'reviews' => $this->reviews,
        ];
    }
}

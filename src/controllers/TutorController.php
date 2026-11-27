<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TutorRepository;

final class TutorController extends AppController
{
    public function __construct(private readonly TutorRepository $tutors)
    {
    }

    public function index(): void
    {
        $level = trim((string) ($_GET['level'] ?? ''));
        $topic = trim((string) ($_GET['topic'] ?? ''));
        $tutors = $this->tutors->findAll($level, $topic);

        $this->render('tutors', [
            'pageTitle' => 'Korepetytorzy z matematyki do matury — MaturaKorki',
            'tutors' => $tutors,
            'resultCount' => count($tutors),
            'filters' => [
                'level' => $level,
                'topic' => $topic,
            ],
            'levels' => ['Podstawa', 'Rozszerzenie'],
            'topics' => $this->tutors->topics(),
        ]);
    }

    public function show(int $id): void
    {
        $tutor = $this->tutors->find($id);

        if ($tutor === null) {
            http_response_code(404);
            $this->render('not-found', [
                'pageTitle' => 'Nie znaleziono korepetytora — MaturaKorki',
            ]);

            return;
        }

        $this->render('tutor', [
            'pageTitle' => $tutor->name . ' — MaturaKorki',
            'tutor' => $tutor,
        ]);
    }
}

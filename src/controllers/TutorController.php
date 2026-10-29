<?php

declare(strict_types=1);

namespace App\Controller;

use App\Support\TutorCatalog;

final class TutorController extends AppController
{
    public function index(): void
    {
        $level = trim((string) ($_GET['level'] ?? ''));
        $topic = trim((string) ($_GET['topic'] ?? ''));
        $tutors = TutorCatalog::filter($level, $topic);

        $this->render('tutors', [
            'pageTitle' => 'Korepetytorzy z matematyki do matury — MaturaKorki',
            'tutors' => $tutors,
            'resultCount' => count($tutors),
            'filters' => [
                'level' => $level,
                'topic' => $topic,
            ],
            'levels' => ['Podstawa', 'Rozszerzenie'],
            'topics' => TutorCatalog::topics(),
        ]);
    }

    public function show(int $id): void
    {
        $tutor = TutorCatalog::find($id);

        if ($tutor === null) {
            http_response_code(404);
            $this->render('not-found', [
                'pageTitle' => 'Nie znaleziono korepetytora — MaturaKorki',
            ]);

            return;
        }

        $this->render('tutor', [
            'pageTitle' => $tutor['name'] . ' — MaturaKorki',
            'tutor' => $tutor,
        ]);
    }
}

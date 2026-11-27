<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TutorRepository;

final class DefaultController extends AppController
{
    public function __construct(private readonly ?TutorRepository $tutors = null)
    {
    }

    public function index(): void
    {
        $allTutors = $this->tutors?->findAll() ?? [];

        $this->render('home', [
            'pageTitle' => 'MaturaKorki — korepetycje z matematyki do matury',
            'featuredTutors' => array_slice($allTutors, 0, 3),
            'levels' => ['Podstawa', 'Rozszerzenie'],
            'topics' => $this->tutors?->topics() ?? [],
        ]);
    }

    public function notFound(): void
    {
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono strony — MaturaKorki',
        ]);
    }

    public function serverError(): void
    {
        http_response_code(500);
        $this->render('server-error', [
            'pageTitle' => 'Błąd serwera — MaturaKorki',
        ]);
    }
}

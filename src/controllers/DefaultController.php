<?php

declare(strict_types=1);

namespace App\Controller;

use App\Support\TutorCatalog;

final class DefaultController extends AppController
{
    public function index(): void
    {
        $this->render('home', [
            'pageTitle' => 'MaturaKorki — korepetycje z matematyki do matury',
            'featuredTutors' => array_slice(TutorCatalog::all(), 0, 3),
            'levels' => ['Podstawa', 'Rozszerzenie'],
            'topics' => TutorCatalog::topics(),
        ]);
    }

    public function notFound(): void
    {
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono strony — MaturaKorki',
        ]);
    }
}

<?php

declare(strict_types=1);

use App\Controller\BookingController;
use App\Controller\DashboardController;
use App\Controller\DefaultController;
use App\Controller\TutorController;
use App\Routing;
use App\Support\Session;

require_once dirname(__DIR__) . '/vendor/autoload.php';

try {
    Session::start();

    $routing = new Routing();

    // Publiczne widoki projektu.
    $routing->get('/', DefaultController::class, 'index');
    $routing->get('/tutors', TutorController::class, 'index');
    $routing->get('/tutors/{id}', TutorController::class, 'show');
    $routing->get('/booking', BookingController::class, 'index');
    $routing->get('/booking/success', BookingController::class, 'success');
    $routing->post('/booking', BookingController::class, 'store');
    $routing->get('/dashboard', DashboardController::class, 'index');

    $routeFound = $routing->dispatch(
        $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI'],
    );

    if (!$routeFound) {
        http_response_code(404);
        (new DefaultController())->notFound();
    }
} catch (\Throwable $exception) {
    error_log(sprintf(
        'MaturaKorki error: %s in %s:%d',
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
    ));

    http_response_code(500);
    (new DefaultController())->serverError();
}

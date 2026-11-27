<?php

declare(strict_types=1);

use App\Controller\AppController;
use App\Controller\BookingController;
use App\Controller\DashboardController;
use App\Controller\DefaultController;
use App\Controller\SecurityController;
use App\Controller\TutorController;
use App\Database;
use App\Repository\BookingRepository;
use App\Repository\TutorRepository;
use App\Routing;
use App\Support\Session;

require_once dirname(__DIR__) . '/vendor/autoload.php';

try {
    Session::start();

    $pdo = (new Database())->connect();
    $tutorRepository = new TutorRepository($pdo);
    $bookingRepository = new BookingRepository($pdo);

    /**
     * Punkt składania zależności: kontrolery dostają repozytoria,
     * zamiast tworzyć połączenie lub repozytorium samodzielnie.
     */
    $controllerFactory = static function (string $class) use (
        $tutorRepository,
        $bookingRepository,
    ): AppController {
        return match ($class) {
            DefaultController::class => new DefaultController($tutorRepository),
            TutorController::class => new TutorController($tutorRepository),
            BookingController::class => new BookingController($tutorRepository, $bookingRepository),
            DashboardController::class => new DashboardController($bookingRepository),
            SecurityController::class => new SecurityController(),
            default => throw new \RuntimeException('Nieznany kontroler: ' . $class),
        };
    };

    $routing = new Routing($controllerFactory);

    // Publiczne widoki projektu.
    $routing->get('/', DefaultController::class, 'index');
    $routing->get('/tutors', TutorController::class, 'index');
    $routing->get('/tutors/{id}', TutorController::class, 'show');
    $routing->get('/booking', BookingController::class, 'index');
    $routing->get('/booking/success', BookingController::class, 'success');
    $routing->post('/booking', BookingController::class, 'store');
    $routing->get('/dashboard', DashboardController::class, 'index');

    // Formularze kont — logika kont po podłączeniu bazy (Lab 9).
    $routing->get('/login', SecurityController::class, 'login');
    $routing->post('/login', SecurityController::class, 'loginSubmit');
    $routing->get('/register', SecurityController::class, 'register');
    $routing->post('/register', SecurityController::class, 'registerSubmit');

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

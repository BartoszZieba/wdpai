<?php

declare(strict_types=1);

namespace App\Controller;

use App\Support\Session;
use App\Validation\AuthValidator;

final class SecurityController extends AppController
{
    private const ROLES = [
        'student' => 'Uczeń',
        'tutor' => 'Korepetytor',
    ];

    public function login(): void
    {
        $errors = Session::pull('errors', []);
        $old = Session::pull('old', []);
        $notice = Session::pull('auth_notice');

        $this->render('auth/login', [
            'pageTitle' => 'Zaloguj się — MaturaKorki',
            'errors' => is_array($errors) ? $errors : [],
            'email' => is_array($old) && is_string($old['email'] ?? null) ? $old['email'] : '',
            'notice' => is_string($notice) ? $notice : null,
            'csrfToken' => Session::csrfToken(),
            'showBackToTop' => false,
        ]);
    }

    public function loginSubmit(): void
    {
        $validator = new AuthValidator();
        $data = $validator->normalizeLogin($_POST);
        $errors = $this->csrfError($_POST['csrf_token'] ?? null);

        if ($errors === []) {
            $errors = $validator->validateLogin($data);
        }

        if ($errors !== []) {
            Session::flash('errors', $errors);
            Session::flash('old', ['email' => $data['email']]);
            $this->redirect('/login');
        }

        // Logowanie zostanie podłączone do tabeli users w Lab 7/9.
        Session::flash('auth_notice', 'Dane są poprawne. Logowanie będzie aktywne po podłączeniu bazy danych (Lab 7/9).');
        Session::flash('old', ['email' => $data['email']]);
        $this->redirect('/login');
    }

    public function register(): void
    {
        $errors = Session::pull('errors', []);
        $old = Session::pull('old', []);
        $notice = Session::pull('auth_notice');
        $requestedRole = $_GET['role'] ?? 'student';
        $oldRole = is_array($old) && is_string($old['role'] ?? null) ? $old['role'] : '';
        $role = array_key_exists($oldRole, self::ROLES)
            ? $oldRole
            : (is_string($requestedRole) && array_key_exists($requestedRole, self::ROLES) ? $requestedRole : 'student');

        $this->render('auth/register', [
            'pageTitle' => 'Załóż konto — MaturaKorki',
            'errors' => is_array($errors) ? $errors : [],
            'name' => is_array($old) && is_string($old['name'] ?? null) ? $old['name'] : '',
            'email' => is_array($old) && is_string($old['email'] ?? null) ? $old['email'] : '',
            'role' => $role,
            'consent' => is_array($old) && ($old['consent'] ?? false) === true,
            'roles' => self::ROLES,
            'notice' => is_string($notice) ? $notice : null,
            'csrfToken' => Session::csrfToken(),
            'showBackToTop' => false,
        ]);
    }

    public function registerSubmit(): void
    {
        $validator = new AuthValidator();
        $data = $validator->normalizeRegister($_POST);
        $errors = $this->csrfError($_POST['csrf_token'] ?? null);

        if ($errors === []) {
            $errors = $validator->validateRegister($data);
        }

        if ($errors !== []) {
            Session::flash('errors', $errors);
            Session::flash('old', [
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'consent' => $data['consent'],
            ]);
            $this->redirect('/register');
        }

        // Rejestracja zostanie podłączona do tabeli users w Lab 7/9.
        Session::flash('auth_notice', 'Formularz jest poprawny. Rejestracja będzie aktywna po podłączeniu bazy danych (Lab 7/9).');
        Session::flash('old', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'consent' => $data['consent'],
        ]);
        $this->redirect('/register');
    }

    /**
     * @return array<string, string>
     */
    private function csrfError(mixed $token): array
    {
        if (Session::verifyCsrf($token)) {
            return [];
        }

        return ['csrf' => 'Sesja wygasła. Odśwież stronę i spróbuj ponownie.'];
    }
}

<?php

declare(strict_types=1);

namespace App\Validation;

final class AuthValidator
{
    /**
     * @return array{email: string, password: string}
     */
    public function normalizeLogin(array $input): array
    {
        return [
            'email' => $this->text($input['email'] ?? ''),
            'password' => $this->rawText($input['password'] ?? ''),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function validateLogin(array $data): array
    {
        $errors = [];

        if ($data['email'] === '') {
            $errors['email'] = 'Podaj adres e-mail.';
        } elseif ($this->length($data['email']) > 120) {
            $errors['email'] = 'Adres e-mail może mieć maksymalnie 120 znaków.';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Podaj poprawny adres e-mail.';
        }

        if ($data['password'] === '') {
            $errors['password'] = 'Podaj hasło.';
        }

        return $errors;
    }

    /**
     * @return array{name: string, email: string, password: string, password_confirm: string, role: string, consent: bool}
     */
    public function normalizeRegister(array $input): array
    {
        return [
            'name' => $this->text($input['name'] ?? ''),
            'email' => $this->text($input['email'] ?? ''),
            'password' => $this->rawText($input['password'] ?? ''),
            'password_confirm' => $this->rawText($input['password_confirm'] ?? ''),
            'role' => $this->text($input['role'] ?? 'student'),
            'consent' => ($input['consent'] ?? '') === '1',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function validateRegister(array $data): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors['name'] = 'Podaj imię i nazwisko.';
        } elseif ($this->length($data['name']) < 3 || $this->length($data['name']) > 80) {
            $errors['name'] = 'Imię i nazwisko musi mieć od 3 do 80 znaków.';
        }

        if ($data['email'] === '') {
            $errors['email'] = 'Podaj adres e-mail.';
        } elseif ($this->length($data['email']) > 120) {
            $errors['email'] = 'Adres e-mail może mieć maksymalnie 120 znaków.';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Podaj poprawny adres e-mail.';
        }

        if ($data['password'] === '') {
            $errors['password'] = 'Podaj hasło.';
        } elseif ($this->length($data['password']) < 8) {
            $errors['password'] = 'Hasło musi mieć co najmniej 8 znaków.';
        }

        if ($data['password_confirm'] === '') {
            $errors['password_confirm'] = 'Powtórz hasło.';
        } elseif ($data['password'] !== $data['password_confirm']) {
            $errors['password_confirm'] = 'Hasła nie są takie same.';
        }

        if (!in_array($data['role'], ['student', 'tutor'], true)) {
            $errors['role'] = 'Wybierz typ konta.';
        }

        if (!$data['consent']) {
            $errors['consent'] = 'Zaakceptuj regulamin i politykę prywatności.';
        }

        return $errors;
    }

    private function text(mixed $value): string
    {
        return is_string($value) ? trim($value) : '';
    }

    private function rawText(mixed $value): string
    {
        return is_string($value) ? $value : '';
    }

    private function length(string $value): int
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value, 'UTF-8');
        }

        $count = preg_match_all('/./us', $value);

        return $count === false ? strlen($value) : $count;
    }
}

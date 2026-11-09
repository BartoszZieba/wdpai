<?php

declare(strict_types=1);

namespace App\Validation;

/**
 * Walidacja danych formularza rezerwacji.
 *
 * Klasa nie zapisuje danych i nie zna sesji — zwraca wyłącznie
 * znormalizowane wartości oraz komunikaty błędów.
 */
final class BookingValidator
{
    /**
     * @param array<string, mixed> $input
     * @return array{name: string, email: string, slot: string, note: string, consent: string}
     */
    public function normalize(array $input): array
    {
        return [
            'name' => $this->stringValue($input, 'name'),
            'email' => $this->stringValue($input, 'email'),
            'slot' => $this->stringValue($input, 'slot'),
            'note' => $this->stringValue($input, 'note'),
            'consent' => $this->stringValue($input, 'consent') === '1' ? '1' : '',
        ];
    }

    /**
     * @param array{name: string, email: string, slot: string, note: string, consent: string} $data
     * @param array<string, mixed> $tutor
     * @return array<string, string>
     */
    public function validate(array $data, array $tutor): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors['name'] = 'Podaj imię i nazwisko.';
        } elseif ($this->length($data['name']) < 3 || $this->length($data['name']) > 80) {
            $errors['name'] = 'Imię i nazwisko musi mieć od 3 do 80 znaków.';
        }

        if ($data['email'] === '') {
            $errors['email'] = 'Podaj adres e-mail.';
        } elseif ($this->length($data['email']) > 120 || filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Podaj poprawny adres e-mail.';
        }

        $availableSlots = $tutor['slots'] ?? [];

        if ($data['slot'] === '') {
            $errors['slot'] = 'Wybierz termin lekcji.';
        } elseif (!is_array($availableSlots) || !in_array($data['slot'], $availableSlots, true)) {
            $errors['slot'] = 'Wybierz termin z listy dostępnych godzin.';
        }

        if ($this->length($data['note']) > 300) {
            $errors['note'] = 'Notatka może mieć maksymalnie 300 znaków.';
        }

        if ($data['consent'] !== '1') {
            $errors['consent'] = 'Zaakceptuj zasady rezerwacji.';
        }

        return $errors;
    }

    /**
     * @param array<string, mixed> $input
     */
    private function stringValue(array $input, string $key): string
    {
        $value = $input[$key] ?? '';

        return is_string($value) ? trim($value) : '';
    }

    private function length(string $value): int
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value, 'UTF-8');
        }

        $length = preg_match_all('/./us', $value);

        return $length === false ? strlen($value) : $length;
    }
}

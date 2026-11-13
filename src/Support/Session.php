<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Cienka warstwa nad sesją PHP.
 *
 * Trzyma w jednym miejscu start sesji, dane tymczasowe (flash),
 * token CSRF i bezpieczne parametry ciasteczka.
 */
final class Session
{
    private const FLASH_KEY = '_flash';
    private const CSRF_KEY = '_csrf';

    public static function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE || headers_sent()) {
            return;
        }

        $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (($_SERVER['SERVER_PORT'] ?? null) === '443');

        session_name('maturakorki_session');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => $secure,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function flash(string $key, mixed $value): void
    {
        if (!isset($_SESSION[self::FLASH_KEY]) || !is_array($_SESSION[self::FLASH_KEY])) {
            $_SESSION[self::FLASH_KEY] = [];
        }

        $_SESSION[self::FLASH_KEY][$key] = $value;
    }

    public static function pull(string $key, mixed $default = null): mixed
    {
        if (!isset($_SESSION[self::FLASH_KEY]) || !is_array($_SESSION[self::FLASH_KEY])) {
            return $default;
        }

        if (!array_key_exists($key, $_SESSION[self::FLASH_KEY])) {
            return $default;
        }

        $value = $_SESSION[self::FLASH_KEY][$key];
        unset($_SESSION[self::FLASH_KEY][$key]);

        return $value;
    }

    public static function csrfToken(): string
    {
        $token = $_SESSION[self::CSRF_KEY] ?? null;

        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            $_SESSION[self::CSRF_KEY] = $token;
        }

        return $token;
    }

    public static function verifyCsrf(mixed $token): bool
    {
        $expected = $_SESSION[self::CSRF_KEY] ?? null;

        return is_string($token)
            && is_string($expected)
            && $expected !== ''
            && hash_equals($expected, $token);
    }
}

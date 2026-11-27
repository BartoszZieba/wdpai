<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

/**
 * Tworzy jedno połączenie PDO do PostgreSQL.
 *
 * Klasa nie jest singletonem — konkretne połączenie jest tworzone
 * w punkcie składania aplikacji (public/index.php) i przekazywane
 * do repozytoriów.
 */
final class Database
{
    private ?PDO $connection = null;

    public function __construct(
        private readonly ?string $host = null,
        private readonly ?int $port = null,
        private readonly ?string $name = null,
        private readonly ?string $user = null,
        private readonly ?string $password = null,
    ) {
    }

    public function connect(): PDO
    {
        if ($this->connection instanceof PDO) {
            return $this->connection;
        }

        $host = $this->host ?? (getenv('DB_HOST') ?: 'db');
        $port = $this->port ?? (int) (getenv('DB_PORT') ?: 5432);
        $name = $this->name ?? (getenv('DB_NAME') ?: 'wdpai');
        $user = $this->user ?? (getenv('DB_USER') ?: 'wdpai_user');
        $password = $this->password ?? (getenv('DB_PASSWORD') ?: 'change_me');

        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s',
            $host,
            $port,
            $name,
        );

        try {
            $this->connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $exception) {
            throw new \RuntimeException(
                'Nie udało się połączyć z bazą danych.',
                0,
                $exception,
            );
        }

        return $this->connection;
    }
}

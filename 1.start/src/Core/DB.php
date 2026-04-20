<?php

namespace App\Core;

class DB
{
    private static ?self $instance = null;
    private ?\PDO $pdo = null;

    public static function init(string $host, string $dbName, string $user, string $password): self
    {
        if (self::$instance === null) {
            self::$instance = new self("mysql:host=$host;dbname=$dbName", $user, $password);
        }
        return self::$instance;
    }

    private function __construct(string $dsn, string $user, string $password)
    {
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * @return self
     * @throws \Exception when DB is not initialized.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            throw new \Exception("Database not initialized, Call DB::init() first.");
        }
        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }

    private function __clone(): void
    {

    }

    private function __wakeup(): void
    {
    }
}
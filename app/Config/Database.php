<?php

declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?self $instance = null;
    private static ?PDO $cnn = null;
    private string $host;
    private string $user;
    private string $password;
    private string $dbname;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->dbname = $_ENV['DB_NAME'];
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        try {
            self::$cnn = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }

        self::$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __clone(): void
    {
    }

}
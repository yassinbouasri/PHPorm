<?php

declare(strict_types=1);

namespace App\Config;

use PDO;

class Database
{
    private static ?self $instance = null;
    private static ?PDO $cnn = null;
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = '';
    private string $dbname = "";

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        self::$cnn = new PDO($dsn, $this->user, $this->password);
        self::$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setDbname(string $dbname): void
    {
        $this->dbname = $dbname;
    }

    public function getConnection(): PDO
    {
        return self::$cnn;
    }

    public function __clone(): void
    {
    }

}
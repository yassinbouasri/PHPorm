<?php

declare(strict_types=1);

namespace App\Config;

use PDO;

class Database
{
    private const string HOST = 'localhost';
    private const string USER = 'root';
    private const string PASSWORD = '';
    private const string DBNAME = "";
    private static ?self $instance = null;
    private static ?PDO $cnn = null;

    public function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8mb4";
        self::$cnn = new PDO($dsn, self::USER, self::PASSWORD);
        self::$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return self::$cnn;
    }

    public function __clone(): void
    {
    }

}
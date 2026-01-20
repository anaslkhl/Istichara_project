<?php


namespace Connection;

use PDO;
use PDOException;

class Database
{
    private ?PDO $pdo;

    private string $host = 'mysql';
    private string $dbname = 'IsticharaDB';
    private string $username = 'root';
    private string $password = 'camus';

    private static ?Database $instance = null;


    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database;
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}


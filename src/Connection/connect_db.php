<?php


class Database
{
    private ?PDO $pdo;

    private string $host = 'mysql';
    private string $dbname = 'IsticharasqlContainer';
    private string $username = 'root';
    private string $password = 'camus';

    private static ?Database $instance = null;


    private function __construct()
    {
        $dataSourceName = "mysql:host={$this->host};dbname={$this->dbname};setcar=utf8mb4";
        $this->pdo = new PDO($dataSourceName, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
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

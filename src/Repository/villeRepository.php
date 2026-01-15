<?php
require_once "../Connection/connect_db.php";

class VilleRepository
{
    private ?PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM ville"); // Your villes table
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

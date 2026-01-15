<?php

require_once "../Connection/connect_db.php";

class avocatRepository {
    private ?PDO $pdo;

    public function __construct() {

        $this->pdo = Database::getInstance()->getConnection();
        
    }

    public function getAvocats($speciality)
    {
        $conn = $this->pdo;

        $stmt = $conn->prepare('SELECT * FROM person WHERE speciality = ?');
        $stmt->execute($speciality);
    }


}
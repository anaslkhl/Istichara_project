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
        $coon = $this->db;
        $stmt = $coon->prepare("SELECT * FROM ville");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createVille($ville)
    {
        try {

            $conn = $this->db;
            $stmt = $conn->prepare('INSERT INTO ville (name) VALUES (?)');
            $stmt->execute([$ville['name']]);

            return true;
        } catch (PDOException $er) {
            print('error : ' . $er->getMessage());
            return false;
            die;
        }
    }

    public function deleteVille($id)
    {
        $conn = $this->db;
        $stmt = $conn->prepare('DELETE FROM ville WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
    public function updateVille($ville)
    {
        $conn = $this->db;
        $stmt = $conn->prepare('UPDATE ville
                                SET name = :name WHERE id = :id');

        $stmt->execute(['name' => $ville['name'], 'id' => $ville['id']]);
    }
}

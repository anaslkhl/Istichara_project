<?php
namespace Repository;
use Connection\Database;
use PDO;
use PDOException;
class ConsultationRepository{

    private ?PDO $pdo;
    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
    }

    public function getByProfessional(int $professionalId): array
    {
        $sql = "
            SELECT r.*, p.fullname AS client_name
            FROM reservation r
            JOIN person p ON p.id = r.client_id
            WHERE r.professionnel_id = ?
            ORDER BY r.date_debut DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$professionalId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



   public function accept(int $reservationId, string $meetingLink): void
{
    $sql = "
        UPDATE reservation
        SET statut = 'valide',
            meeting_link = ?
        WHERE id = ?
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$meetingLink, $reservationId]);
}


public function reject(int $reservationId): void
{
    $sql = "
        UPDATE reservation
        SET statut = 'refuse'
        WHERE id = ?
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$reservationId]);
}



}
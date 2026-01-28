<?php

namespace Repository;

use Connection\Database;
use PDO;
use PDOException;

class reservationRepository
{

    private ?PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllReservations(int $professionalId): array
    {
        $stmt = $this->db->prepare('SELECT 
                                        reservation.id, 
                                        reservation.client_id, 
                                        reservation.professionnel_id, 
                                        reservation.jour, 
                                        reservation.heure_debut, 
                                        reservation.heure_fin, 
                                        reservation.statut, 
                                        person.fullname 
                                    FROM reservation
                                    LEFT JOIN person ON person.id = reservation.client_id
                                    WHERE reservation.professionnel_id = ?');
        $stmt->execute([$professionalId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptReservation(int $reservationId)
    {
        $stmt = $this->db->prepare('update reservation set statut = "valide" where id = ?');
        $stmt->execute([$reservationId]);
    }

    public function rejectReservation(int $reservationId)
    {
        $stmt = $this->db->prepare('update reservation set statut = "refuse" where id = ?');
        $stmt->execute([$reservationId]);
    }

    public function addReservation($reservation)
    {
        $stmt = $this->db->prepare('insert into reservation (client_id, professionnel_id, jour, heure_debut, heure_fin, status
                                    values(?, ?, ?, ?, ?, ?)');
        $stmt->execute([
                $reservation['clienId'],
                $reservation['professionnalId'],
                $reservation['jour'],
                $reservation['heure_debut'],
                $reservation['heure_fin'],
                $reservation['status'],
        ]);
    }

    public function removeReservation($rowId)
    {
        $stmt = $this->db->prepare('delete from reservation where id = ?');
        $stmt->execute([$rowId]);
    }
}

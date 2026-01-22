<?php

namespace Repository;

use Connection\Database;
use PDO;
use PDOException;


class availabilityRepository
{

    private ?PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

       
    public function insertAvailability($timeTableRow)
    {
        $stmt = $this->db->prepare('insert into disponibilite (professionnel_id, jour, heure_debut, heure_fin) values (?, ?, ?, ?)');
        $stmt->execute([
            $timeTableRow['proId'],
            $timeTableRow['jour'],
            $timeTableRow['fromHour'],
            $timeTableRow['toHour']
        ]);
    }

    public function getTimetable($professionalId):array
    {
        $stmt = $this->db->prepare('select jour, heure_debut, heure_fin from disponibilite where professionnel_id = ?');
        $stmt->execute([$professionalId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
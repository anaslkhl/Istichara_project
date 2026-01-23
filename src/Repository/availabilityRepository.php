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
    
    public function updateAvailability($timeTableRow)
    {
        $stmt = $this->db->prepare('update disponibilite set jour = ?, heure_debut = ?, heure_fin = ? where id = ?');
        $stmt->execute([
            $timeTableRow['jour'],
            $timeTableRow['fromHour'],
            $timeTableRow['toHour'],
            $timeTableRow['rowId']
        ]);
    }

    public function getTimetable($professionalId):array
    {
        $stmt = $this->db->prepare('select id, professionnel_id, jour, HOUR(heure_debut) as heure_debut, HOUR(heure_fin) as heure_fin from disponibilite where professionnel_id = ?');
        $stmt->execute([$professionalId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getavailability($rowId)
    {
        $stmt = $this->db->prepare('select * from disponibilite where id = ?');
        $stmt->execute([$rowId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);// i do not know if this will work(cs i'm only getting one row)
    }


    public function deleteAvailability($rowId)
    {
        $stmt = $this->db->prepare('delete from disponibilite where id = ?');
        $stmt->execute([$rowId]);
    }

}
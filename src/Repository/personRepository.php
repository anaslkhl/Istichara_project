<?php

namespace Repository;

use Connection\Database;
use PDO;
use PDOException;


class personRepository
{

    private ?PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    public function createPerson($person)
    {
        try {
            $conn = $this->db;
            $stmt = $conn->prepare('INSERT INTO person (fullname, email, phone,	experience,	tarif,	speciality,	consultate_online,	type_actes,	ville_id)
                                VALUES (?,?,?,?,?,?,?,?,?)');

            $stmt->execute([
                $person['fullname'],
                $person['email'],
                $person['phone'],
                $person['experience'],
                $person['tarif'],
                $person['speciality'],
                $person['consultate_online'],
                $person['type_actes'],
                $person['ville_id']
            ]);
            header('location: professionals');
            return true;
        } catch (PDOException $er) {
            print('ErRor : ' . $er->getMessage());
            return false;
            die;
        }
    }

    public function getAllPersons()
    {
        $conn = $this->db;

        $stmt = $conn->prepare('SELECT * FROM person');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updatePerson($person): bool
    {
        try {

            $conn = $this->db;
            $stmt = $conn->prepare('UPDATE person
                                SET fullname = :fullname, email = :email, phone = :phone,	experience = :experience,
                                	tarif = :tarif,	speciality = :speciality,	consultate_online = :consultate_online,
                                    	type_actes = :type_actes,	ville_id = :ville_id
                                        WHERE id = :id');

            $stmt->execute([

                'fullname' => $person['fullname'],
                'email' => $person['email'],
                'phone' => $person['phone'],
                'experience' => $person['experience'],
                'tarif' => $person['tarif'],
                'speciality' => $person['speciality'],
                'consultate_online' => $person['consultate_online'],
                'type_actes' => $person['type_actes'],
                'ville_id' => $person['ville_id'],
                'id' => $person['id']

            ]);
            return true;
        } catch (PDOException $er) {
            print('ErrOr : ' . $er->getMessage());
            return false;
            die;
        }
    }

    public function deletePerson($id)
    {
        try {
            $conn = $this->db;
            $stmt = $conn->prepare('DELETE FROM person WHERE id = :id');

            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $er) {
            print('EError : ' . $er->getMessage());
            return false;
            die;
        }
    }

    public function getPerson($id)
    {
        $con = $this->db;
        $stmt = $con->prepare('SELECT * FROM person WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // public function filterByName($query)
    // {
    //     $conn = $this->db;
    //     if (!$query) {
    //         $stmt = $conn->prepare("SELECT * FROM person");
    //         $stmt->execute();
    //     } else {
    //         $stmt = $conn->prepare("SELECT * FROM person WHERE fullname LIKE ?");
    //         $stmt->execute(["%{$query}%"]);
    //     }
    //     return $stmt->fetchAll();
    // }

    public function filterByNameAndType($name = '', $type = ''): array
    {
        $sql = "SELECT * FROM person WHERE fullname LIKE :name";
        $params = ['name' => "%$name%"];

        if ($type === 'avocat') {
            $sql .= " AND speciality IS NOT NULL";
        } elseif ($type === 'huissier') {
            $sql .= " AND type_actes IS NOT NULL";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function countByType(string $type): int
    {
        $conn = $this->db;

        if ($type === 'avocat') {
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM person WHERE speciality IS NOT NULL");
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM person WHERE type_actes IS NOT NULL");
        }

        $stmt->execute();
        $row = $stmt->fetch();
        return (int)$row['total'];
    }

    public function getByCity(): array
    {
        $conn = $this->db;
        $stmt = $conn->prepare("SELECT ville_id, COUNT(*) as total FROM person GROUP BY ville_id");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $cityName = $this->getCityName($row['ville_id']);

            $result[$cityName] = $row['total'];
        }
        return $result;
    }

    private function getCityName($ville_id): string
    {
        $stmt = $this->db->prepare("SELECT name FROM ville WHERE id = ?");
        $stmt->execute([$ville_id]);
        $row = $stmt->fetch();
        return $row['name'] ?? 'Unknown';
    }

    public function topAvocats(int $limit = 3): array
    {
        $stmt = $this->db->prepare("SELECT * FROM person WHERE speciality IS NOT NULL ORDER BY experience DESC LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

<?php

require_once "../Connection/connect_db.php";

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
                $person['name'],
                $person['email'],
                $person['phone'],
                $person['experience'],
                $person['tarif'],
                $person['speciality'],
                $person['consultate_online'],
                $person['type_actes'],
                $person['ville_id']
            ]);

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

    public function updatePerson($person)
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
}

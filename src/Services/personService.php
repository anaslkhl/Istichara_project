<?php

namespace Services;

use Exception;
use Repository\personRepository;

class personService
{

    private personRepository $repository;

    public function __construct()
    {
        $this->repository = new personRepository();
    }

    public function getAll()
    {
        return $this->repository->getAllPersons();
    }


    public function checkData($data)
    {
        $requiredFields = [
            'fullname' => 'Full name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'role' => 'Role',
            'experience' => 'Experience',
            'tarif' => 'Tarif',
            'ville_id' => 'Ville ID',

        ];

        $clinetRequiredFields = [

            'fullname' => 'Full name',
            'email' => 'Email',
            'password' => 'Password',
        ];


        if (isset($data['role']) && $data['role'] === 'avocat') {
            $requiredFields['speciality'] = 'Speciality';
            $requiredFields['consultate_online'] = 'Consultation Online';
        } elseif (isset($data['role']) && $data['role'] === 'huissier') {
            $requiredFields['type_actes'] = 'Type of Acts';
        }

        if ($data['role'] === 'client') {

            foreach ($clinetRequiredFields as $field => $label) {
                if (empty($data[$field])) {
                    throw new Exception("$label is required !");
                }
            }
            return true;
        } elseif ($data['role'] === 'avocat' || $data['role'] === 'huissier') {

            foreach ($requiredFields as $field => $label) {
                if (empty($data[$field])) {
                    // var_dump($field);
                    throw new Exception("$label is required !!");
                }
            }

            return true;
        }
    }

    public function Store($data)
    {
        // var_dump($_POST);
        // var_dump($_FILES);
        // exit;


        if (in_array($data['role'], ['avocat', 'huissier'])) {

            $uploadDir = dirname(__DIR__) . '/public/uploads/';

            if (
                !isset($_FILES['uploadfile']) ||
                $_FILES['uploadfile']['error'] !== UPLOAD_ERR_OK
            ) {
                throw new Exception("Fichier requis");
            }

            if (!is_writable($uploadDir)) {
                throw new Exception("Dossier uploads non accessible");
            }

            $fileName = time() . '_' . basename($_FILES['uploadfile']['name']);
            $targetFile = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $targetFile)) {
                throw new Exception("Erreur lors du téléchargement");
            }

            $data['uploadfile'] = $fileName;
        }
        
        if ($this->checkData($data)) {

            if ($data['role'] === 'avocat') {
                $data['type_actes'] = null;
            }
            if ($data['role'] === 'huissier') {
                $data['speciality'] = null;
                $data['consultate_online'] = null;
            }
            if ($data['role'] === 'client') {
                unset(
                    $data['type_actes'],
                    $data['speciality'],
                    $data['consultate_online'],
                    $data['tarif'],
                    $data['experience'],
                    $data['uploadfile'],
                    $data['ville_id'],
                    $data['phone']
                );
            }

            $person = [
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'experience' => $data['experience'],
                'tarif' => $data['tarif'],
                'role' => $data['role'] ?? null,
                'speciality' => $data['speciality'] ?? null,
                'consultate_online' => $data['consultate_online'] ?? null,
                'type_actes' => $data['type_actes'] ?? null,
                'ville_id' => $data['ville_id'],
                'fichier_acceptation' => $data['uploadfile'] ?? null
            ];

            // var_dump($person);
            // exit;
            return $this->repository->createPerson($person);
        }
    }


    public function update(array $data): bool
    {
        if (!isset($data['id'])) {
            throw new Exception('Id is not find and its required to update !');
        }

        if ($data['role'] === 'avocat') {
            $data['type_actes'] = null;
        }
        if ($data['role'] === 'huissier') {
            $data['speciality'] = null;
            $data['consultate_online'] = null;
        }

        if ($this->checkData($data)) {

            return $this->repository->updatePerson($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        return $this->repository->deletePerson($id);
    }


    public function countByType(string $type): int
    {
        $repo = new personRepository();
        return $repo->countByType($type);
    }

    public function getByCity(): array
    {
        $repo = new personRepository();
        return $repo->getByCity();
    }

    public function topAvocats(int $limit = 3): array
    {
        $repo = new personRepository();
        return $repo->topAvocats($limit);
    }
    public function houres_worked()
    {
        $total_houres = new personRepository;
        return $total_houres->total_houres_worked();
    }
    public function chiffre_afaires()
    {
        $chiffres = new personRepository;
        return $chiffres->chifresAffaires();
    }
    public function unique_clients()
    {
        $total_unique = new personRepository;
        return $total_unique->unique_clients();
    }
    public function total_reservation()
    {
        $total_reservation = new personRepository;
        return $total_reservation->totale_resarvation();
    }
}

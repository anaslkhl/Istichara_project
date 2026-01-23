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
        } elseif (isset($data['role']) && $data['role'] === 'huisser') {
            $requiredFields['type_actes'] = 'Type of Acts';
        }

        if ($data['role'] === 'client') {

            foreach ($clinetRequiredFields as $field => $label) {
                if (!isset($data[$field]) || $data[$field] === '') {
                    throw new Exception("$label is required !");
                }
            }
            return true;
        } elseif ($data['role'] === 'avocat' || $data['role'] === 'huisser') {

            foreach ($requiredFields as $field => $label) {
                if (!isset($data[$field]) || $data[$field] === '') {
                    // var_dump($field);
                    throw new Exception("$label is required !!");
                }
            }

            return true;
        }
    }

    public function Store($data)
    {


        if (in_array($data['role'], ['avocat', 'huisser'])) {

            $uploadDir = dirname(__DIR__) . '/public/uploads/';

            if (!isset($_FILES['uploadfile']) || $_FILES['uploadfile']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Fichier requis");
            }

            $originalName = $_FILES['uploadfile']['name'];
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

            $safeName = iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalName, PATHINFO_FILENAME));
            $safeName = preg_replace('/[^A-Za-z0-9_-]/', '_', $safeName);

            $fileName = time() . '_' . $safeName . '.' . $extension;
            $targetFile = $uploadDir . $fileName;

            if (file_exists($targetFile)) {
                throw new Exception("Fichier déjà existant");
            }

            // if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $targetFile)) {
            //     throw new Exception("Erreur upload");
            // }

            $data['uploadfile'] = $fileName;
        }


        if ($this->checkData($data)) {

            if ($data['role'] === 'avocat') {
                $data['type_actes'] = null;
            }
            if ($data['role'] === 'huisser') {
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
        if ($data['role'] === 'huisser') {
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

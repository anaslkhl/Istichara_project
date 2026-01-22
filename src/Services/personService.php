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
            'speciality' => '',
            'ville_id' => 'Ville ID',
            'fichier_acceptation' => 'Fichier acceptation',

        ];

        $clinetRequiredFields = [

            'fullname' => 'Full name',
            'email' => 'Email',
            'phone' => 'Phone',
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
                    throw new Exception("$label is required");
                }
                return true;
            }
        } elseif ($data['role'] === 'avocat' || $data['role'] === 'huissier') {

            foreach ($requiredFields as $field => $label) {
                if (empty($data[$field])) {
                    throw new Exception("$label is required");
                }
            }

            return true;
        }
    }

    public function Store($data)
    {

        if ($this->checkData($data)) {

            if ($data['role'] === 'avocat') {
                $data['type_actes'] = null;
            }
            if ($data['role'] === 'huissier') {
                $data['speciality'] = null;
                $data['consultate_online'] = null;
            }
            if ($data['role'] === 'client') {
                $data['type_actes'] = null;
                $data['speciality'] = null;
                $data['consultate_online'] = null;
                $data['tarif'] = null;
                $data['experience'] = null;
                $data['fichier_acceptation'] = null;
                $data['ville_id'] = null;
                $data['phone'] = null;
            }

            $person = [
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'experience' => $data['experience'],
                'tarif' => $data['tarif'],
                'role' => $data['role'],
                'speciality' => $data['speciality'],
                'consultate_online' => $data['consultate_online'],
                'type_actes' => $data['type_actes'],
                'ville_id' => $data['ville_id'],
                'fichier_acceptation' => $data['fichier_acceptation']
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
}

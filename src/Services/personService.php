<?php

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
            'experience' => 'Experience',
            'tarif' => 'Tarif',
            'speciality' => 'Speciality',
            'consultate_online' => 'Consultation Online',
            'type_actes' => 'Type of Acts',
            'ville_id' => 'Ville ID'
        ];

        foreach ($requiredFields as $field => $label) {
            if (empty($data[$field])) {
                throw new Exception("$label is required");
            }
        }
        return true;
    }

    public function Store($data)
    {
        if ($this->checkData($data)) {

            $person = [

                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'experience' => $data['experience'],
                'tarif' => $data['tarif'],
                'speciality' => $data['speciality'],
                'consultate_online' => $data['consultate_online'],
                'type_actes' => $data['type_actes'],
                'ville_id' => $data['ville_id'],
                'id' => $data['id']

            ];
            return $this->repository->createPerson($person);
        }
    }


    public function update(array $data): bool
    {
        if (!isset($data['id'])) {
            throw new Exception('Id is not find and its required to update !');
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
}

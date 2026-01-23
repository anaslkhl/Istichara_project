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
            'experience' => 'Experience',
            'tarif' => 'Tarif',
            'ville_id' => 'Ville ID'
        ];

        if (isset($data['role']) && $data['role'] === 'avocat') {
            $requiredFields['speciality'] = 'Speciality';
            $requiredFields['consultate_online'] = 'Consultation Online';
        } elseif (isset($data['role']) && $data['role'] === 'huissier') {
            $requiredFields['type_actes'] = 'Type of Acts';
        }

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

            if ($data['role'] === 'avocat') {
                $data['type_actes'] = null;
            }
            if ($data['role'] === 'huissier') {
                $data['speciality'] = null;
                $data['consultate_online'] = null;
                
            }

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


    /// statistiques admin Task
    public function topAvocats(int $limit = 3): array
    {
        $repo = new personRepository();
        return $repo->topAvocats($limit);
    }
    public function houres_worked(){
        $total_houres = new personRepository;
        return $total_houres->total_houres_worked();
    }
    public function chiffre_afaires(){
        $chiffres = new personRepository;
        return $chiffres->chifresAffaires();
    }
    public function unique_clients(){
        $total_unique= new personRepository;
        return $total_unique->unique_clients();
    }
    public function total_reservation(){
        $total_reservation = new personRepository;
        return $total_reservation->totale_resarvation();
    }
    ///statistiques professionnel Task
    public function total_consultation(){
        $total_consultation=new personRepository;
        return $total_consultation->total_consultation();
    }
    public function total_houres_worked_person(){
        $total_houres_worked_person = new personRepository;
        return $total_houres_worked_person->total_houres_worked_person();
    }
    public function chiffres_affaires_person(){
        $chiffres_affaires_person = new personRepository;
        return $chiffres_affaires_person->chiffres_affaires_person();
    }
    public function total_demandes_attendus(){
        $total_demandes_attendus = new personRepository;
        return $total_demandes_attendus->total_demandes_attendus();
    } 

    /// show professionel profile 

    public function getbyid($id){
        $professionnel = new personRepository;
        return $professionnel->getPerson($id);
    }
    
    /// viewers task

    public function viewers_profile(){
        $viewers = new personRepository;
        return $viewers->viewers_profile();
    }
}

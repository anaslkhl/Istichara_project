<?php

namespace Controllers;

use Services\personService;
use Repository\personRepository;


class personController
{
    private PersonService $service;

    public function __construct()
    {
        $this->service = new PersonService();
    }

    public function professionals()
    {
        $persons = $this->service->getAll();
        require __DIR__ . '/../public/professionals.php';
    }
    public function huisser()
    {
        require __DIR__ . '/../public/huisser.php';
    }

    public function avocat()
    {
        require __DIR__ . '/../public/avocat.php';
    }
    public function create()
    {
        require __DIR__ . '/../public/form.php';
    }

    public function delete()
    {
        $this->service->delete($_POST['delete']);
        require __DIR__ . '/../public/professionals.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            $service = new personService();

            try {
                $service->update($data);
                header('Location: /professionals');
                exit;
            } catch (\Exception $e) {
                die('Update failed: ' . $e->getMessage());
            }
        } else {
            die('Invalid request method');
        }
    }

    public function dashboard()
    {
        require __DIR__ . '/../public/dashboard.php';
    }

    public function edit($id)
    {
        $personRepo = new personRepository();
        $person = $personRepo->getPerson($id);

        require __DIR__ . '/../public/form.php';
    }


    public function main()
    {
        require __DIR__ . '/../public/main.php';
    }

    public function store()
    {
        $this->service->store($_POST);
        exit;
    }

    public function clientInscription()
    {
        require __DIR__ . '/../public/clientInscription.php';
    }
    public function professional_dashboared(){
        require __DIR__ . '/../public/professionel_dashboard.php';
    }
    public function professional_reservation(){
        require __DIR__ . '/../public/professional_reservation.php';
    }
    public function professional_consultation(){
        require __DIR__ . '/../public/professional_consultation.php';
    }
}

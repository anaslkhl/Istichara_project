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
        $this->render('dashboard');
        exit;
    }

    private function render($view, $data = [])
    {
        extract($data);
        // require_once __DIR__ . '/../public/header.php';
        require __DIR__ . '/../public/' . $view . '.php'; // page content
        // require_once __DIR__ . '/../public/footer.php';
    }

    public function edit($id)
    {
        $personRepo = new personRepository();
        $person = $personRepo->getPerson($id);

        require __DIR__ . '/../public/form.php';
    }


    public function main()
    {
        $this->render('main');
    }

    public function store()
    {
        $this->service->store($_POST);
        exit;
    }

    public function clientInscription()
    {
        $this->render('clientInscription');
    }
    public function professional_dashboared()
    {
        $this->render('professional_dashboared');
    }
    public function professional_reservation()
    {
        $this->render('professional_reservation');
    }
    public function professional_consultation()
    {
        $this->render('professional_consultation');
    }
    public function showprofile()
    {
        $this->render('showprofile');
    }

    public function getAllClients()
    {
        $cl = new personService();
        $clients = $cl->getAllClients();
        require_once __DIR__ . '/../public/client.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = $_POST;
            $log = new personService;
            $log->login($data); // 👈 YOU FORGOT THIS

            // require __DIR__ . '/../public/login.php';
        }
    }

    public function logout()
    {
        $logout = new personService();
        $logout->logout();
        exit;
    }
}

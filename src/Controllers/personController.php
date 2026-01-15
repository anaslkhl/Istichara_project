<?php
require_once "../Services/personService.php";

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
        require __DIR__ . '/../Public/professionals.php';
    }
    public function huisser()
    {
        require __DIR__ . '/../Public/huisser.php';
    }

    public function avocat() 
    {
        require __DIR__ . '/../Public/avocat.php';
    }
    public function create()
    {
        require __DIR__ . '/../Public/form.php';
    }

    public function main()
    {
        require __DIR__ . '/../Public/main.php';
    }

    public function store()
    {
        $this->service->store($_POST);
        header('Location: /person');
        exit;
    }
}

<?php

namespace Controllers;

use Services\availabilityService;
use Repository\availabilityRepository;


class availabilityController
{
    private availabilityService $availabilityService;

    public function __construct()
    {
        $this->availabilityService = new availabilityService();
    }

    public function availability()
    {
        $availabilities = $this->availabilityService->getTimetable(179);
        
        require __DIR__ . '/../public/availabilityManagement.php';

    }

    public function insertAvailability(): void
    {
        $this->availabilityService->insertAvailability();

        header('Location: ' . $_ENV['base_url'] . '/availability');
        exit;
    }

    // public function getTimetable($professionalId)
    // {
    //     $availabilities = $this->availabilityService->getTimetable($professionalId);
    //     require_once __DIR__ . '/../public/availabilityManagement.php';
    // }

    public function updateAvailability()
    {
        $this->availabilityService->updateAvailability();

        header('Location: ' . $_ENV['base_url'] . '/availability');
        exit;
    }

    // public function getAvailability()
    // {
    //     $oldAvailability = $this->availabilityService->getAvailability($_GET['rowId']);

    //     header('Location: ' . $_ENV['base_url'] . '/availability');
    //     exit;
    // }

    public function deleteAvailability()
    {
        $this->availabilityService->deleteAvailability($_GET['rowId']);

        header('Location: ' . $_ENV['base_url'] . '/availability');
        exit;
    }

    public function setRowId()
    {
        require __DIR__ . '/../public/availabilityManagement.php';
    }

}

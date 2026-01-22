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

}

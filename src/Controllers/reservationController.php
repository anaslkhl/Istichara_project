<?php

namespace Controllers;

use Services\reservationService;
use Repository\reservationRepository;

class reservationController {

    private reservationService $reservationService;

    public function __construct()
    {
        $this->reservationService = new reservationService();
    }

    public function reservations()
    {
        $reservations = $this->reservationService->getAllReservations(104);// i still need the session id
        require __DIR__ . '/../public/professional_reservation.php';
    }

    public function acceptReservation()
    {
        $this->reservationService->acceptReservation($_GET['reservationId']);

        header('Location: ' . $_ENV['base_url'] . '/reservations');
        exit;
    }

    public function rejectReservation()
    {
        $this->reservationService->rejectReservation($_GET['reservationId']);

        header('Location: ' . $_ENV['base_url'] . '/reservations');
        exit;
    }

    public function addReservation()
    {
        $this->reservationService->addReservation(98, 104);//clienId and professionnalId

        header('Location: ' . $_ENV['base_url'] . '/professionals');
        exit;
    }

    public function removeReservation()
    {
        $this->reservationService->removeReservation(); // row id

        header('Location: ' . $_ENV['base_url'] . '/professionals');
        exit;
    }
}
<?php

namespace Services;

use Exception;
use Repository\reservationRepository;

class reservationService {

    private reservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new reservationRepository();
    }

    public function getAllReservations(int $professionnalId)
    {
        return $this->reservationRepository->getAllReservations($professionnalId);
    }

    public function acceptReservation(int $reservationId)
    {
        $this->reservationRepository->acceptReservation($reservationId);
    }

    public function rejectReservation(int $reservationId)
    {
        $this->reservationRepository->rejectReservation($reservationId);
    }

    public function addReservation(int $clienId, int $professionnalId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jour'], $_POST['heure_debut'], $_POST['heure_fin'])) {
            $jour = $_POST['jour'];
            $heure_debut = $_POST['heure_debut'];
            $heure_fin = $_POST['heure_fin'];
    

            // small validation 

            $start = (int) $heure_debut;
            $end = (int) $heure_fin;

            if (
                ($start < $end) && (in_array($jour, ['lundi', 'mardi', 'mercredi', 'jeudi','vendredi', 'samedi', 'dimanche']))
                ) {

                $reservation = [
                    "clienId"=>$clienId,
                    "professionnalId"=>$professionnalId,
                    "jour"=> $jour,
                    "heure_debut"=> $heure_debut . ":00:00",
                    "heure_fin"=> $heure_fin . ":00:00"
                ];

                
                $this->reservationRepository->addReservation($reservation);
                
            }
        }
    }

    public function removeReservation($rowId)
    {
        $this->reservationRepository->removeReservation($rowId);
    }
}
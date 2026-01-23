<?php

namespace Services;

use Exception;
use Repository\availabilityRepository;

class availabilityService
{

    private availabilityRepository $availabilityRepository;

    public function __construct()
    {
        $this->availabilityRepository = new availabilityRepository();
    }

    
    public function insertAvailability()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $day = $_POST['day'];
            $start_hour = $_POST['start_hour'];
            $end_hour = $_POST['end_hour'];

            // valid hours inputs

            $start = (int) $start_hour;
            $end = (int) $end_hour;

            if ($start < $end) {

                $timeTableRow = [
                    "proId"=> 179,// i'm waiting for the session id
                    "jour"=> $day,
                    "fromHour"=> $start_hour,
                    "toHour"=> $end_hour,
                ];

                $this->availabilityRepository->insertAvailability($timeTableRow);
                
            }
        }
    }

    public function getTimetable($professionalId): array
    {
        return $this->availabilityRepository->getTimetable($professionalId);
    }

    public function updateAvailability()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $day = $_POST['day'];
            $start_hour = $_POST['start_hour'];
            $end_hour = $_POST['end_hour'];

            // valid hours inputs

            $start = (int) $start_hour;
            $end = (int) $end_hour;

            if ($start < $end) {

                $timeTableRow = [
                    "rowId"=>$_GET['rowId'],
                    "jour"=> $day,
                    "fromHour"=> $start_hour,
                    "toHour"=> $end_hour,
                ];

                $this->availabilityRepository->insertAvailability($timeTableRow);
                
            }
        }
    }

    public function getavailability($rowId)
    {
        return $this->availabilityRepository->getavailability($rowId);
    }


    public function deleteAvailability($rowId)
    {
        $this->availabilityRepository->deleteAvailability($rowId);
    }
}
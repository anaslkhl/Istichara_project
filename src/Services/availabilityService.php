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
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['day'], $_POST['start_hour'], $_POST['end_hour'])) {
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
                    "fromHour"=> $start_hour . ":00:00",
                    "toHour"=> $end_hour . ":00:00",
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rowId'], $_POST['new_day'], $_POST['new_start_hour'], $_POST['new_end_hour'])) {
            $rowId = $_POST['rowId'];
            $day = $_POST['new_day'];
            $start_hour = $_POST['new_start_hour'];
            $end_hour = $_POST['new_end_hour'];

            // valid hours inputs

            $start = (int) $start_hour;
            $end = (int) $end_hour;

            if ($start < $end) {

                $timeTableRow = [
                    "rowId"=>$rowId,
                    "jour"=> $day,
                    "fromHour"=> $start_hour . ":00:00",
                    "toHour"=> $end_hour . ":00:00",
                ];

                $this->availabilityRepository->updateAvailability($timeTableRow);
                
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
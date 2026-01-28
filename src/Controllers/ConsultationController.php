<?php

namespace Controllers;

use Repository\ConsultationRepository;
use Services\ZoomService;

class ConsultationController
{
    private ConsultationRepository $repo;
    private ZoomService $zoom;

    public function __construct()
    {
        $this->repo = new ConsultationRepository();
        $this->zoom = new ZoomService();
    }

    public function index()
    {
        $professionalId = 98; 

        if (!$professionalId) {
            header('Location: /login');
            exit;
        }

        $consultations = $this->repo->getByProfessional($professionalId);
        require __DIR__ . '/../public/professional_consultation.php';
    }

    public function accept(int $id)
    {
        if (!$id) {
            header('Location: /professional_consultation');
            exit;
        }

        try {
            $meetingLink = $this->zoom->createMeeting(
                'Consultation juridique',
                date('Y-m-d\TH:i:s')
            );
        } catch (\Exception $e) {
         $meetingLink = 'https://meet.jit.si/consultation_' . uniqid();
        }

        $this->repo->accept($id, $meetingLink);

        header('Location: /professional_consultation');
        exit;
    }
    public function reject(int $id)
    {
        if (!$id) {
            header('Location: /professional_consultation');
            exit;
        }

        $this->repo->reject($id);

        header('Location: /professional_consultation');
        exit;
    }
}

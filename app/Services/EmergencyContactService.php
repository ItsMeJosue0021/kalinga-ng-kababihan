<?php

namespace App\Services;

use App\Repositories\Interfaces\EmergencyContactRepositoryInterface;

class EmergencyContactService
{
    protected $emergencyContactRepository;

    public function __construct(EmergencyContactRepositoryInterface $emergencyContactRepository)
    {
        $this->emergencyContactRepository = $emergencyContactRepository;
    }

    public function getAllEmergencyContacts()
    {
        return $this->emergencyContactRepository->getAll();
    }
}

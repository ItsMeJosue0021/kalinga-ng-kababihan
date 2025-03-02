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

    public function findEmergencyContactById($id)
    {
        return $this->emergencyContactRepository->find($id);
    }

    public function createEmergencyContact(array $data)
    {
        return $this->emergencyContactRepository->create($data);
    }

    public function updateEmergencyContact($id, array $data)
    {
        return $this->emergencyContactRepository->update($id, $data);
    }

    public function deleteEmergencyContact($id)
    {
        return $this->emergencyContactRepository->delete($id);
    }
}

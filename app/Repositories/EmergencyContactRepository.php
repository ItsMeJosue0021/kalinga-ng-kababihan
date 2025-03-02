<?php

namespace App\Repositories;

use App\Models\EmergencyContact;
use App\Repositories\Interfaces\EmergencyContactRepositoryInterface;

class EmergencyContactRepository implements EmergencyContactRepositoryInterface
{
    public function getAll()
    {
        return EmergencyContact::all();
    }

    public function find($id)
    {
        return EmergencyContact::findOrFail($id);
    }

    public function create(array $data)
    {
        return EmergencyContact::create($data);
    }

    public function update($id, array $data)
    {
        $emergencyContact = EmergencyContact::findOrFail($id);
        $emergencyContact->update($data);
        return $emergencyContact;
    }

    public function delete($id)
    {
        $emergencyContact = EmergencyContact::findOrFail($id);
        $emergencyContact->delete();
        return true;
    }
}

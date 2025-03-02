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
}

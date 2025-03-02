<?php

namespace App\Http\Controllers;

use App\Services\EmergencyContactService;

class EmergencyContactController extends Controller
{
    protected $emergencyContactService;

    public function __construct(EmergencyContactService $emergencyContactService)
    {
        $this->emergencyContactService = $emergencyContactService;
    }

    public function index()
    {
        $emergencyContacts = $this->emergencyContactService->getAllEmergencyContacts();
        return response()->json($emergencyContacts, 200);
    }
}

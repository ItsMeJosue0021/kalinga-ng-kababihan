<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function show($id)
    {
        $emergencyContact = $this->emergencyContactService->findEmergencyContactById($id);
        return response()->json($emergencyContact);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:15',
            'fb_messenger_account' => 'nullable|string|max:255',
            'relationship' => 'required|string|max:50',
        ]);

        $emergencyContact = $this->emergencyContactService->createEmergencyContact($validatedData);
        return response()->json($emergencyContact, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:15',
            'fb_messenger_account' => 'nullable|string|max:255',
            'relationship' => 'required|string|max:50',
        ]);

        $emergencyContact = $this->emergencyContactService->updateEmergencyContact($id, $validatedData);
        return response()->json($emergencyContact);
    }

    public function destroy($id)
    {
        $this->emergencyContactService->deleteEmergencyContact($id);
        return response()->json(null, 204);
    }
}

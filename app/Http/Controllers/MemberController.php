<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = $this->memberService->getAllMembers();
        return response()->json($members, 200);
    }

    public function show($id)
    {
        $member = $this->memberService->findMemberById($id);
        return response()->json($member);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'dob' => 'required|date',
            'civil_status' => 'required|string|max:50',
            'contact_number' => 'required|string|max:15',
            'fb_messenger_account' => 'nullable|string|max:255',
        ]);

        $member = $this->memberService->createMember($validatedData);
        return response()->json($member, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'dob' => 'required|date',
            'civil_status' => 'required|string|max:50',
            'contact_number' => 'required|string|max:15',
            'fb_messenger_account' => 'nullable|string|max:255',
        ]);

        $member = $this->memberService->updateMember($id, $validatedData);
        return response()->json($member, 200);
    }

    public function destroy($id)
    {
        $this->memberService->deleteMember($id);
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileInfoRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function uploadProfilePicture($id, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($user) {
            if ($user->image) {
                Storage::delete($user->image);
            }
            $path = $request->file('image')->store('profile_pictures', 'public');
            $user->image = $path;
            $user->save();
            
            return response()->json([
                'message' => 'Image uploaded successfully',
                'path' => $path,
            ], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }

    }

    public function update(UpdateProfileInfoRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        try {
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'contact_number' => $request->contactNo,
                'block' => $request->block,
                'lot' => $request->lot,
                'steet' => $request->street,
                'dubdivision' => $request->subdivision,
                'baranggy' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update profile.'], 500);
        }
        return response()->json(['message' => 'Profile updated successfully.'], 200);
    }

    public function changePassword(ChangePasswordRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $currentPassword = $user->password;

        if (!Hash::check($request->oldPassword, $currentPassword)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        try {
            $user->update(['password' => Hash::make($request->newPassword)]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to change password.'], 500);
        }

        return response()->json(['message' => 'Password changed successfully.'], 200);
    }
}

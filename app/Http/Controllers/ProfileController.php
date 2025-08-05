<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileInfoRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function uploadProfilePicture(Request $request)
     {
         $request->validate([
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);

         $user = auth()->user();
         $profile = Profile::where('user_id', $user->id)->first();

         if ($profile) {
             // Delete the old profile picture if it exists
             if ($profile->profile_picture) {
                 Storage::delete($profile->profile_picture);
             }
         } else {
             // Create a new profile if it doesn't exist
             $profile = new Profile();
             $profile->user_id = $user->id;
         }

         // Store the new profile picture
         $path = $request->file('profile_picture')->store('profile_pictures', 'public');
         $profile->profile_picture = $path;
         $profile->save();

         return response()->json(['message' => 'Profile picture uploaded successfully.']);

         $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('uploads', 'public');

            return response()->json([
                'message' => 'Image uploaded successfully',
                'path' => $path,
            ]);
        }
     }

    public function update(UpdateProfileInfoRequest $request, $id): JsonResponse {
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

    public function changePassword(ChangePasswordRequest $request, $id): JsonResponse{
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

<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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



}

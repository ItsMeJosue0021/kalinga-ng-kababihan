<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registers a new user.
     */
    public function register(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 2;

        $user = User::create($data);

        return response([
            "message" => "User created successfully"
        ], 201);
    }

    /**
     * Logs the user in.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'Invalid credentials',], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user->load('role')->load('profile'),
            'access_token' => $token
        ]);
    }

    /**
     * Logs the user out.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response(['message' => 'Logged out'], 200);
    }

    /**
     * Returns the authenticated user.
     */
    public function user(Request $request)
    {
        return response(['user' => $request->user()->load('role')], 200);
    }

    public function users()
    {
        return response(['users' => User::all()], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Check if a password is provided
        if ($request->filled('password')) {
            // Compare new password with the existing one
            if (!Hash::check($request->password, $user->password)) {
                // If they are different, hash and update it
                $validatedData['password'] = Hash::make($request->password);
            } else {
                // If the same, remove password from the update data
                unset($validatedData['password']);
            }
        } else {
            // If no password is provided, remove it from update data
            unset($validatedData['password']);
        }

        // Update user data
        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

}

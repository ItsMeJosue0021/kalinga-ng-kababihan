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


}

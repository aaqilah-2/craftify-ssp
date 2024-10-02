<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Authenticates or registers a user.
     *
     * @param Request $request The request object containing user data.
     * @return mixed The authentication or registration result.
     */
    public function authenticate(Request $request)
    {
        return rescue(function () use ($request) {
            // Get only the email and the password
            $credentials = $request->only('email', 'password');

            // Authenticate the user
            if (Auth::attempt($credentials)) {

                // User exists and credentials are valid, log them in
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $user
                ]);
            } else {
                // If the user doesn't exist, create the user
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8',
                    'role' => ['required', 'in:' . implode(',', array_column(UserRole::cases(), 'value'))], // Validate role based on UserRole enum
                ]);

                // Create the new user with the provided role using enum
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => UserRole::from($validated['role'])->value, // Store role as integer from enum
                ]);

                // Token creation
                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'message' => 'Registration successful',
                    'token' => $token,
                    'user' => $user
                ]);
            }

        }, function ($e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                '_time' => now()
            ], 401);
        });
    }

    public function logout(Request $request)
{
    $user = Auth::user();

    // Log to check if the user is retrieved successfully
    if (!$user) {
        Log::info('User not authenticated during logout. Token might be invalid or expired.');
        return response()->json(['message' => 'User not authenticated'], 401);
    }


    // Revoke the user's token
    
    $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

    return response()->json(['message' => 'Successfully logged out'], 200);
}



    
}

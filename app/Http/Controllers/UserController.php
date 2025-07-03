<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Student;
use App\Models\Guardian;

class UserController extends Controller
{


    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Create the User
        $user = User::create($validated);

        // Create the role-based profile
        if ($validated['role'] === 'student') {
            Student::create([
                'user_id' => $user->id,
                'institution' => $validated['institution'],
                'share_location' => $validated['share_location'] ?? false,
                'auto_alert_on_missed_calls' => $validated['auto_alert_on_missed_calls'] ?? false,
            ]);
        } elseif ($validated['role'] === 'guardian') {
            Guardian::create([
                'user_id' => $user->id,
                'relationship' => $validated['relationship'],
            ]);
        }

        // Log the user in and generate Sanctum token
        auth()->login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
            'token' => $token
        ], 201);
    }


    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        $loginField = $credentials['login'];
        $password = $credentials['password'];

        // Determine if login is email or phone
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt authentication
        if (!auth()->attempt([$fieldType => $loginField, 'password' => $password])) {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'user' => $user,
            'token' => $token
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
                'unique:users,phone',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
        ]);

        $token = $user->createToken(
            'web-client'
        )->plainTextToken;

        return response()->json([
            'message' => 'Registration successful.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],

            'device_name' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $user = User::where(
            'email',
            $validated['email']
        )->first();

        if (
            ! $user ||
            ! Hash::check(
                $validated['password'],
                $user->password
            )
        ) {
            throw ValidationException::withMessages([
                'email' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'message' => 'Your account is not active.',
            ], 403);
        }

        $token = $user->createToken(
            $validated['device_name'] ?? 'web-client'
        )->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $request->user()->load('roles'),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request
            ->user()
            ->currentAccessToken()
            ?->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}

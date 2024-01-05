<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = UserService::store($request->toArray());

        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();

            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'You are not logged in']);
    }
}

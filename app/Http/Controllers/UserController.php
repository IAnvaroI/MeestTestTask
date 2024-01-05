<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(): JsonResponse
    {
        UserService::delete(Auth::user()->id);

        return response()->json(['message' => 'User deleted successfully']);
    }
}

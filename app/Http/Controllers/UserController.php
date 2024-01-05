<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(): JsonResponse
    {
        $status = UserService::delete(Auth::user()->id);

        if($status){
            return response()->json(['message' => 'User deleted successfully']);
        }

        return response()->json(['message' => 'User was not deleted'], 500);
    }
}

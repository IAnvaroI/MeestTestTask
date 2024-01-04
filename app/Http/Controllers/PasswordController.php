<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Services\PasswordService;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    public function update(UpdatePasswordRequest $request): JsonResponse
    {
        $status = PasswordService::update($request->user(), $request->toArray());

        if ($status) {
            return response()->json(['message' => 'Password updated successfully']);
        }

        return response()->json(['message' => 'Password was not updated'], 422);
    }
}

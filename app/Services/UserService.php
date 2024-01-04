<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService
{
    /**
     * Store a user in storage.
     */
    public static function store(array $fields)
    {
        try {
            $fields['password'] = Hash::make($fields['password']);

            return User::create($fields);
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }

    /**
     * Remove the user from storage.
     */
    public static function delete(string $id): bool
    {
        try {
            if (!User::destroy($id)) {
                throw new Exception("Model not found.", 404);
            }

            return true;
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }
}

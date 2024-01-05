<?php

namespace App\Services;

use App\Models\User;
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
            $user = User::findOrFail($id);
            $user->delete();

            return true;
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }
}

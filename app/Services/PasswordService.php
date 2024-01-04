<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class PasswordService
{
    /**
     * Update a password in storage.
     */
    public static function update(User $user, array $passwords): bool
    {
        try {
            if (Hash::check($passwords['old_password'], $user->password)) {
                $hashedNewPassword = Hash::make($passwords['new_password']);

                $user->update(['password' => $hashedNewPassword]);

                return true;
            }

            return false;
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }
}

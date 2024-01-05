<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class PasswordService
{
    /**
     * Update a password in storage.
     */
    public static function update(User $user, array $passwords): bool
    {
        if (Hash::check($passwords['old_password'], $user->password)) {
            $hashedNewPassword = Hash::make($passwords['new_password']);

            $user->update(['password' => $hashedNewPassword]);

            return true;
        }

        return false;
    }
}

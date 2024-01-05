<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Store a user in storage.
     */
    public static function store(array $fields)
    {
        $fields['password'] = Hash::make($fields['password']);

        return User::create($fields);
    }

    /**
     * Remove the user from storage.
     */
    public static function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}

<?php

namespace L0MAX\PasswordHistoryChecker;

use Illuminate\Support\Facades\DB;

class PasswordHistoryChecker
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function isPasswordReused($newPassword): bool
    {
        // Fetch user's password history
        $passwordHistory = DB::table('password_histories')
            ->where('user_id', $this->user->id)
            ->pluck('password'); // This assumes passwords are hashed

        foreach ($passwordHistory as $oldPassword) {
            if (password_verify($newPassword, $oldPassword)) {
                return true;
            }
        }

        return false;
    }

    public function savePasswordToHistory($newPassword)
    {
        // Save the new password to the password history table
        DB::table('password_histories')->insert([
            'user_id' => $this->user->id,
            'password' => bcrypt($newPassword),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

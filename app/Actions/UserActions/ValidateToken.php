<?php

namespace App\Actions\UserActions;

use Illuminate\Support\Facades\Auth;

class ValidateToken
{
    public function execute()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(['message' => 'Token is valid', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Token is invalid'], 401);
        }
    }
}

<?php

namespace App\Actions\UserActions;

use Illuminate\Support\Facades\Auth;

class RefreshToken
{
    public function execute()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(['success' => true, 'message' => 'Token is valid', 'user' => $user]);
        } else {
            return response()->json(['success' => false, 'message' => 'Token is invalid'], 401);
        }
    }
}

<?php

namespace App\Actions\UserActions;

use Illuminate\Support\Facades\Cookie;

class LogoutUserAction
{
    public function execute()
    {
        auth()->user()->token()->revoke();
        Cookie::forget('token');
        return  response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}

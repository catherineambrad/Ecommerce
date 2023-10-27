<?php

namespace App\Actions\UserActions;

class LogoutUserAction
{
    public function execute()
    {
        auth()->user()->token()->revoke();

        return  response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], 200)->withoutCookie('token');
    }
}

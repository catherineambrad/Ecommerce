<?php

namespace App\Actions\UserActions;

class LogoutUserAction
{
    public function execute()
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'Logged out'];
    }
}

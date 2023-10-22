<?php

namespace App\Actions\UserActions;
use Illuminate\Support\Facades\Cookie;

class LogoutUserAction
{
    public function execute()
    {
        auth()->user()->tokens()->delete();
        Cookie::forget('token');
        return  response()->json(['message' => 'Logged out'], 201);
    }
}

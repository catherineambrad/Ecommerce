<?php

namespace App\Actions\UserActions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(array $data)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            // successfull authentication
            $user = User::with('role')->find(Auth::user()->id);
            $user_token = $user->createToken('auth_token')->accessToken;;

            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200)
                ->withCookie(
                    'token',
                    $user_token,
                    config('jwt.ttl'),
                    '/',
                    'localhost',
                    false,
                    false
                );
        } else {
            // failure to authenticate
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate.',
            ], 401);
        }
    }
}

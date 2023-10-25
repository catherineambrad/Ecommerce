<?php

namespace App\Actions\UserActions;

class RefreshToken
{
    public function execute()
    {
        $newToken = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            'success' => true,
            'token' => $newToken,
            'user' => auth()->user(),
        ], 200)
            ->withCookie(
                'token',
                $newToken,
                config('jwt.ttl'),
                '/',
                'localhost',
                false,
                false
            );
    }
}

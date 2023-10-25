<?php

namespace App\Actions\UserActions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserAction
{
    public function execute(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $user_token = $user->createToken('auth_token')->accessToken;

        if (Auth::attempt($data)) {
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
            return response()->json([
                'success' => false,
                'email' => $data['email'],
                'massage' => 'Email ou mot de passe incorrect.'
            ], 401);
        }
    }
}

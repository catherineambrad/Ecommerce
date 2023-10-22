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

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        if (Auth::attempt($data)) {
            return response()->json($response, 201)->withCookie('token', $token, config('jwt.ttl'), '/', 'localhost', false, false);
        } else {
            return response()->json(['email' => $data['email'], 'massage' => 'Email ou mot de passe incorrect.'], 201);
        }
    }
}

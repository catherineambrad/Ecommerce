<?php

namespace App\Actions\UserActions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    public function execute(array $data)
    {
        // Check email 
        $user = User::where('email', $data['email'])->first();

        // Check password
        if (!$user || !Hash::check($data['password'], $user->password))
            return response(['message' => 'Bad cred'], 401);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response(['user' => $user, 'token' => $token], 201)->withCookie('token', $token, config('jwt.ttl'), '/', 'localhost', false, false);
    }
}

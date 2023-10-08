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
            return response(['message' => 'Bad creds'], 401);


        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return response($response, 201);
    }
}

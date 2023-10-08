<?php

namespace App\Actions\UserActions;

use App\Models\User;

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

        return response($response, 201);
    }
}

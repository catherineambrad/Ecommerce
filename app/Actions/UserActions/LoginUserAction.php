<?php

namespace App\Actions\UserActions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    public function execute(array $data)
    {
        // Check email 
        $user = User::whereEmail($data['email'])->first();

        // Check password
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Bad credentials'], 401);
        }

        // Attempt to log in the user after password validation
        $token = $user->createToken('api')->plainTextToken;

        if (Auth::attempt($data)) {
            return response()->json(['user' => $user, 'token' => $token], 201)->withCookie('token', $token, config('jwt.ttl'), '/', 'localhost', false, false);
        }
    }
}

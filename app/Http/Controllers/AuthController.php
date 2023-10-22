<?php

namespace App\Http\Controllers;

use App\Actions\UserActions\LoginUserAction;
use App\Actions\UserActions\LogoutUserAction;
use App\Actions\UserActions\RegisterUserAction;
use App\Actions\UserActions\RefreshToken;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function register(RegisterUserAction $registerUserAction, AuthRequest $request)
    {
        return $registerUserAction->execute($request->validated());
    }

    public function login(LoginUserAction $loginUserAction, AuthRequest $request)
    {
        return $loginUserAction->execute($request->validated());
    }

    public function logout(LogoutUserAction $logoutUserAction)
    {
        return $logoutUserAction->execute();
    }

    public function refreshToken(RefreshToken $refreshToken)
    {
        return $refreshToken->execute();
    }
}

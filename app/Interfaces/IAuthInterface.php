<?php

namespace App\Interfaces;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

interface IAuthInterface
{
    public function login(LoginUserRequest $request);

    public function register(RegisterUserRequest $request);

    public function logout();

    public function refresh();

    public function userProfile();
}

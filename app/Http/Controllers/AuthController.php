<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        return $this->userService->login($request);
    }

    public function register(RegisterResource $request)
    {
        return $this->userService->register($request->all());
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }
}

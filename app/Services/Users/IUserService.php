<?php

namespace App\Services\Users;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

interface IUserService
{
    public function login(Request $request) : object;
    public function register(array $request) ;
    public function logout($request);
}

<?php

namespace App\Services\Users;

use App\Http\Resources\LoginResource;
use App\Repository\Users\IUserRepository;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements IUserService
{
    use ResponseAPI;
    /**
     * @param  IUserRepository  $userRepo
     */
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login($request): object
    {
        $user = $this->userRepo->findByUsername($request->username);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error('Username Or Password Wrong.', 400);
        }
        return $this->success('Login SuccessFully', new LoginResource($user));
    }

    public function register(array $request)
    {
        try {
            $this->userRepo->create($request);
        } catch (\Exception $e) {
            report($e);
            return $this->error('Server Error.', 500);
        }
        return $this->success('Register SuccessFully');
    }

    public function logout($request)
    {
        try {
            $request->user()->tokens()->delete();
        } catch (\Exception $e) {
            report($e);
            return $this->error('Server Error.', 500);
        }
        return $this->success('Logout SuccessFully', null);
    }
}

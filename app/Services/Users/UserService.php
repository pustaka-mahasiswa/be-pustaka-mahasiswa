<?php

namespace App\Services\Users;

use App\Http\Resources\LoginResource;
use App\Repository\Users\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements IUserService
{
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
            throw ValidationException::withMessages([
                'error' => ['Username or Password Wrong'],
            ]);
        }
//       $token = $user->createToken('token')->plainTextToken;
        return new LoginResource($user);
    }

    public function register(array $request)
    {
        try {
            $this->userRepo->create($request);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => ['terjadi kesalahan'],
            ]);
        }

        return response()->json([
            'message' => 'Berhasil Mendaftar',
        ]);
    }

    public function logout($request)
    {
        try {
            $request->user()->tokens()->delete();
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => ['terjadi kesalahan'],
            ]);
        }

        return response()->json([
            'message' => 'Berhasil keluar',
        ]);
    }
}

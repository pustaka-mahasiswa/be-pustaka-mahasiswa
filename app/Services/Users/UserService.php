<?php

namespace App\Services\Users;

use App\Http\Resources\LoginResource;
use App\Repository\Users\IUserRepository;
use App\Services\Reward\IRewardService;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    use ResponseAPI;

    private IUserRepository $userRepo;
    private IRewardService $rewardService;
    /**
     * @param  IUserRepository  $userRepo
     */
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login($request): object
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepo->findByUsername($request->username);
            $this->rewardService->getUserReward($request->rewardId);
            DB::commit();
        } catch (\Exception $e)
        {
            DB::rollBack();
            report($e);
            return $this->error('Server Error.');
        }
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

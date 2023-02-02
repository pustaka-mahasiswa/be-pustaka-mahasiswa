<?php

namespace App\Services\Reward;

use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class RewardService implements IRewardService
{


    public function listReward(Request $request): object
    {

    }

    public function createReward(Request $request): void
    {
        try {

        } catch (\Exception $e)
        {
            throw ValidationException::withMessages([
                'error' => ['Terjadi Kesalah Server'],
            ]);
        }
    }

    public function updateReward(Request $request, int $rewardId): void
    {
        // TODO: Implement updateReward() method.
    }

    public function deleteReward(int $rewardId): void
    {
        // TODO: Implement deleteReward() method.
    }


}

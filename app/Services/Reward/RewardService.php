<?php

namespace App\Services\Reward;

use App\Repository\Reward\IRewardRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class RewardService implements IRewardService
{
    use ResponseAPI;
    /**
     * @param IRewardRepository $rewardRepo
     */
    public function __construct(IRewardRepository $rewardRepo)
    {
        $this->rewardRepo = $rewardRepo;
    }


    public function listReward(Request $request): object
    {
        $rewardList = $this->rewardRepo->list();
        if (!$rewardList)
        {
            return $this->success("list Rewards", []);
        }
        return $this->success("list Rewards", $rewardList);
    }

    public function createReward(Request $request): JsonResponse
    {
        try {
            $this->rewardRepo->create($request);
            return $this->success("create reward successfully");
        } catch (\Exception $e) {
            report($e);
            return $this->error("Server Error");
        }
    }

    public function updateReward(Request $request, int $rewardId): JsonResponse
    {
        try {
            $this->rewardRepo->update($request, $rewardId);
            return $this->success("update reward successfully");
        } catch (\Exception $e) {
            report($e);
            return $this->error("Server Error");
        }
    }

    public function deleteReward(int $rewardId): JsonResponse
    {
        try {
            $this->rewardRepo->update($rewardId);
            return $this->success("deleted reward successfully");
        } catch (\Exception $e) {
            report($e);
            return $this->error("Server Error");
        }
    }

    public function getUserReward(int $rewardId): void
    {
        try {
            $reward = $this->rewardRepo->findRewardById($rewardId);
            $this->rewardRepo->userReward($reward, auth()->user());
        } catch (\Exception $e) {
            report($e);
        }
    }


}

<?php

namespace App\Services\Reward;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

interface IRewardService
{
    public function listReward(Request $request): object;

    public function createReward(Request $request): JsonResponse;

    public function updateReward(Request $request, int $rewardId): JsonResponse;

    public function deleteReward(int $rewardId): JsonResponse;

    public function getUserReward(int $rewardId): void;
}

<?php

namespace App\Services\Reward;

use Illuminate\Support\Facades\Request;

interface IRewardService
{
    public function listReward(Request $request) : object;
    public function createReward(Request $request) : void;
    public function updateReward(Request $request, int $rewardId) : void;
    public function deleteReward(int $rewardId) : void;
}

<?php

namespace App\Repository\Reward;

interface IRewardRepository
{
    public function list(): object;

    public function create($data);

    public function update($data, int $rewardId);

    public function destroy(int $rewardId);
}

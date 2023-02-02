<?php

namespace App\Repository\Reward;

interface IRewardRepository
{
    public function list(): object;

    public function findRewardById(int $rewardId): object;

    public function create($data): void;

    public function update($data, int $rewardId): void;

    public function destroy(int $rewardId): void;

    public function userReward(object $reward, object $user): void;
}

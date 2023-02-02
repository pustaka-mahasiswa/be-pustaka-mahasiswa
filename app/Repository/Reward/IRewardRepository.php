<?php

namespace App\Repository\Reward;

interface IRewardRepository
{
    public function list(): object;

    public function create($data): void;

    public function update($data, int $rewardId): void;

    public function destroy(int $rewardId): void;
}

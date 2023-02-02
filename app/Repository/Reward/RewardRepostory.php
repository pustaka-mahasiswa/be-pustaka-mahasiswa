<?php

namespace App\Repository\Reward;

use App\Http\Resources\RewardResource;
use App\Models\Reward;

class RewardRepostory implements IRewardRepository
{
    /**
     * @param  Reward  $reward
     */
    public function __construct(Reward $reward)
    {
        $this->reward = $reward;
    }

    public function list(): object
    {
        return RewardResource::collection($this->reward->newQuery()->get());
    }

    public function create($data): void
    {
         $this->reward
            ->newQuery()
            ->create($data);
    }

    public function update($data, int $rewardId): void
    {
        $this->reward
            ->newQuery()
            ->findOrFail($rewardId)
            ->update($data);
    }

    public function destroy(int $rewardId): void
    {
        $this->reward
            ->newQuery()
            ->findOrFail($rewardId)
            ->delete();
    }
}

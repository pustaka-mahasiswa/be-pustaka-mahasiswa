<?php

namespace App\Repository\Reward;

use App\Http\Resources\RewardResource;
use App\Models\LoginReward;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;

class RewardRepostory implements IRewardRepository
{
    private Reward $reward;
    private LoginReward $loginReward;

    /**
     * @param  Reward  $reward
     */
    public function __construct(Reward $reward, LoginReward $loginReward)
    {
        $this->reward = $reward;
        $this->loginReward = $loginReward;
    }

    public function list(): object
    {
        return RewardResource::collection($this->reward->newQuery()->get());
    }

    public function findRewardById(int $rewardId): object
    {
        return new RewardResource(
            $this->reward
                ->newQuery()
                ->findOrFail($rewardId)
        );
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

    private function doubleBonusSaku($reward): int
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

         $weeklyTotal = $this->loginReward
             ->newQuery()
             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
             ->sum();

         if ($weeklyTotal % 3 == 0)
         {
             $reward *= 2;
         }
         return $reward;
    }

    public function userReward(object $reward, object $user): void
    {

        try {
            DB::beginTransaction();
            $this->loginReward
                ->newQuery()
                ->create([
                    "reward_id" => $reward->id,
                    'user_id' => $user->id
                ]);
            $rewardValue =$this->doubleBonusSaku($reward->value);
            $user->total_pocket_money += $rewardValue;
            $user->save();
            DB::commit();
        } catch (\Exception $e)
        {
            report($e);
            DB::rollBack();
        }

    }


}

<?php

namespace App\Http\Controllers;

use App\Services\Reward\IRewardService;
use Illuminate\Support\Facades\Request;

class RewardController extends Controller
{
    /**
     * @param IRewardService $rewardService
     */
    public function __construct(IRewardService $rewardService)
    {
        $this->rewardService = $rewardService;
    }


    public function index()
    {
        $listReward = $this->rewardService->listReward();
        return response()->json($listReward, 200);
    }

    public function create(Request $request)
    {
        return $this->rewardService->createReward($request->all());
    }
}

<?php

namespace App\Providers;

use App\Repository\Reward\IRewardRepository;
use App\Repository\Reward\RewardRepostory;
use App\Repository\Users\IUserRepository;
use App\Repository\Users\UserRepository;
use App\Services\Reward\IRewardService;
use App\Services\Reward\RewardService;
use App\Services\Users\IUserService;
use App\Services\Users\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PustakaProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IUserService::class, UserService::class);
        $this->app->singleton(IUserRepository::class, UserRepository::class);

        $this->app->singleton(IRewardService::class, RewardService::class);
        $this->app->singleton(IRewardRepository::class, RewardRepostory::class);
    }

    public function provides()
    {
        return [
            IUserService::class,
            IUserRepository::class,
            IRewardService::class,
            IRewardRepository::class
        ]; // TODO: Change the autogenerated stub
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repository\Users\IUserRepository;
use App\Repository\Users\UserRepository;
use App\Services\Users\IUserService;
use App\Services\Users\UserService;
use Illuminate\Support\ServiceProvider;

class PustakaProvider extends ServiceProvider
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

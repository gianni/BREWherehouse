<?php

namespace App\Providers;

use App\Interfaces\BeerRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BeerRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BeerRepositoryInterface::class, BeerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

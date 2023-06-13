<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\BookingRepository::class, 
            \App\Repositories\Eloquent\BookingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ClientRepository::class, 
            \App\Repositories\Eloquent\ClientRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\VehicleRepository::class, 
            \App\Repositories\Eloquent\VehicleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SlotRepository::class, 
            \App\Repositories\Eloquent\SlotRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

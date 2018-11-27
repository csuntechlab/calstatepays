<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PowerUsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\PowerUsersContract',
            'App\Services\PowerUsersService'
        );
    }
}

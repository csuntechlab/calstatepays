<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PfreServiceProvider extends ServiceProvider
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
            'App\Contracts\PfreContract',
            'App\Services\PfreService'
        );
    }
}

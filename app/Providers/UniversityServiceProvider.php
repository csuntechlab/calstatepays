<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UniversityServiceProvider extends ServiceProvider
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
            'App\Contracts\UniversityContract',
            'App\Services\UniversityService'
        );
    }
}

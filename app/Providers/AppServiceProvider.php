<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UrgentCurier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\UrgentCurier', function ($app) {
            return new UrgentCurier();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

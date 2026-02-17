<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Disable collision exception handler if present
        if (class_exists(\NunoMaduro\Collision\Provider::class)) {
            // Prevent the collision service provider from being registered
            $this->app->resolving('Laravel\Octane\Listeners\SetRequestForNextProvider', function () {
                // Override to avoid collision conflicts
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
<?php

namespace Rvslan\Aimon;

use Illuminate\Support\ServiceProvider;

class AimonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/aimon.php' => config_path('aimon.php'),
        ]);

        if (config('aimon.database.enabled')) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    public function register()
    {
        $this->app->singleton(Aimon::class, function () {
            return new Aimon;
        });
        $this->app->bind('aimon', Aimon::class);
    }
}

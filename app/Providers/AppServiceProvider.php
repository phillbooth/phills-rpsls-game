<?php

namespace App\Providers;

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(App\Games\RPSLSGame::class, function ($app) {
            return new App\Games\RPSLSGame();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \App\Console\Commands\PlayGame::class,
            ]);
        }
    }
}

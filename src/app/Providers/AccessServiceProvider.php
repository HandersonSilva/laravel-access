<?php

namespace SecurityTools\LaravelAccess\Providers;

use Illuminate\Support\Facades\Artisan;
use SecurityTools\LaravelAccess\Console\Commands\AccessCommand;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/access_env.php' => config_path('access.php'),
        ], 'access-config');

        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/laravel-access/public'),
        ], 'access-public');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-access'),
        ], 'access-views');

        $this->loadRoutesFrom(__DIR__.'/../../routes/access.php');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->configureCommands();
    }

    /**
     * Configure the commands offered by your application.
     */
    public function configureCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AccessCommand::class,
            ]);
        }
    }
}

<?php

namespace SecurityTools\LaravelAccess\Providers;

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
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'access-migrations');

        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/laravel-access/public'),
        ], 'access-public');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-access'),
        ], 'access-views');

        $this->loadRoutesFrom(__DIR__.'/../../routes/access.php');
    }
}

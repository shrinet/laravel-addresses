<?php

declare(strict_types=1);

namespace Werxe\Addresses;

use Illuminate\Support\ServiceProvider;

class AddressesServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Publish migrations
            $this->publishes([
                realpath(__DIR__.'/../database/migrations') => database_path('migrations'),
            ], 'werxe:addresses.migrations');

            // Load migrations
            $this->loadMigrationsFrom(
                realpath(__DIR__.'/../database/migrations')
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }
}

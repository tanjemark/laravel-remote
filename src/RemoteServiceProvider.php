<?php

namespace Anjemark\Remote;

use Illuminate\Support\ServiceProvider;
use Anjemark\Remote\Console\SyncDbCommand;
use Anjemark\Remote\Console\ArtisanCommand;

class RemoteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/remote.php' => config_path('remote.php')
        ], 'remote');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ArtisanCommand::class,
                SyncDbCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/remote.php', 'remote');
    }
}

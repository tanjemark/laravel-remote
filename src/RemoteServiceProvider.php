<?php

namespace Anjemark\Remote;

use Anjemark\Remote\Console\DbCommand;
use Illuminate\Support\ServiceProvider;
use Anjemark\Remote\Console\ArtisanCommand;
use Anjemark\Remote\Console\ExportDbCommand;
use Anjemark\Remote\Console\InsertDbCommand;

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
                DbCommand::class,
                ArtisanCommand::class,
                ExportDbCommand::class,
                InsertDbCommand::class,
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

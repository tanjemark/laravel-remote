<?php

namespace Tanjemark\LaravelRemote;

use Tanjemark\LaravelRemote\Console\DbCommand;
use Illuminate\Support\ServiceProvider;
use Tanjemark\LaravelRemote\Console\ArtisanCommand;
use Tanjemark\LaravelRemote\Console\ExportDbCommand;
use Tanjemark\LaravelRemote\Console\InsertDbCommand;

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

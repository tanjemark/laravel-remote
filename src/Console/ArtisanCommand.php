<?php

namespace Tanjemark\LaravelRemote\Console;

use Illuminate\Console\Command;
use Tanjemark\LaravelRemote\Traits\SSHable;

class ArtisanCommand extends Command
{
    use SSHable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:artisan {alias} {cmd}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute php artisan command remotely.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->connect($this->argument('alias'));
                
        $output = $this->command('php artisan ' . $this->argument('cmd'));

        $this->info($output);

        $this->disconnect();
    }
}

<?php

namespace Anjemark\Remote\Console;

use Illuminate\Console\Command;
use Anjemark\Remote\Traits\SSHable;

class ArtisanCommand extends Command
{
    use SSHable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:artisan {channel} {cmd}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run php artisan commands remote.';

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
        $this->connect($this->argument('channel'));
                
        $output = $this->command('php artisan ' . $this->argument('cmd'));

        $this->info($output);

        $this->disconnect();
    }
}

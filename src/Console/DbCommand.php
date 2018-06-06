<?php

namespace Anjemark\Remote\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Anjemark\Remote\Jobs\SyncDbJob;
use Anjemark\Remote\Traits\SSHable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DbCommand extends Command
{
    use SSHable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:db-sync {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync database.';

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
        $this->connect($this->argument('from'));
            $this->info('Start exporting database from ' . $this->argument('from'));
            $content = $this->command('php artisan remote:export');
        $this->disconnect();
        
        $this->info('');

        if (base64_decode($content)) {
            $this->connect($this->argument('to'));
                $this->info('Start inserting database to ' . $this->argument('to'));
                $this->command('php artisan remote:insert ' . $content);
            $this->disconnect();
        }
    }
}

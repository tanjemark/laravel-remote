<?php

namespace Anjemark\Remote\Console;

use Illuminate\Console\Command;
use Anjemark\Remote\Jobs\SyncDbJob;
use Anjemark\Remote\Traits\SSHable;

class SyncDbCommand extends Command
{
    use SSHable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:db {channel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync db from remote server.';

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
        $this->info('Start');

        SyncDbJob::dispatch();

        $this->info('Done');
    }
}

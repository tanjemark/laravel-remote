<?php

namespace Tanjemark\LaravelRemote\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertDbCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:insert {content}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert database.';

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
        $this->call('migrate:fresh');

        $content = base64_decode($this->argument('content'));
        
        collect(json_decode($content))->each(function ($table, $index) {
            $columns = collect($table->columns)->map(function ($column) {
                return collect($column)->toArray();
            })->toArray();
            
            DB::table($table->table)->insert($columns);
        });
    }
}

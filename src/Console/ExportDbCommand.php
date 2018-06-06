<?php

namespace Tanjemark\Remote\Console;

use Faker\Generator as Faker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDbCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export database.';

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
    public function handle(Faker $faker)
    {
        $tables = config('remote.tables');
        
        $content = collect($tables)->map(function ($table) use ($faker) {
            $rows = DB::table($table)->get();
            
            $output['table'] = $table;
            $output['columns'] = $rows->map(function ($row) use ($table, $faker) {
                return collect($row)->map(function ($value, $column) use ($table, $faker) {
                    if ($fake = config("remote.fake.$table.$column")) {
                        $value = $faker->{$fake};
                    }
                    return $value;
                });
            });

            return $output;
        })->toArray();

        $this->info(base64_encode(json_encode($content)));
    }
}

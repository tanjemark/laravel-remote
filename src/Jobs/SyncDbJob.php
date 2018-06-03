<?php

namespace Anjemark\Remote\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Faker\Generator as Faker;

class SyncDbJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Faker $faker)
    {
        $tables = DB::select('SHOW TABLES');
        $database = config('database.connections.mysql.database');

        $content = collect($tables)->map(function ($table) use ($database, $faker) {
            $tableName = $table->{'Tables_in_' . $database};
            
            $rows = DB::table($tableName)->get();
            
            $output[$tableName] = $rows->map(function ($row) use ($tableName, $faker) {
                return collect($row)->map(function ($value, $column) use ($tableName, $faker) {
                    if ($fake = config("remote.fake.$tableName.$column")) {
                        $value = $faker->{$fake};
                    }
                    return $value;
                });
            });

            return $output;
        });

        $fileName = str_replace(' ', '-', 'db_' . $database . '_' . Carbon::now() .'.json');
        
        $file = new Filesystem();
        $file->put(storage_path($fileName), $content);
    }
}

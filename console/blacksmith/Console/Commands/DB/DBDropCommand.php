<?php

namespace Blacksmith\Console\Commands\DB;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class DBDropCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop
                           {tables : The table to truncate. If multiple, separate by comma, enclosed in quotations}
                           {--a|all : Drop all tables including the migrations table}
                           {--f|force : Force drop without user prompt.}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop the tables specified. Also drops all versions of the table.';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Create a new migration rollback command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator  $migrator
     * @return void
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct();

        $this->migrator = $migrator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $tables = explode(',', $this->argument('tables'));

        Schema::disableForeignKeyConstraints();

        if ($this->option('all')) {
            if (! $this->option('force') && ! $this->confirm("You are about to drop all tables. Are you sure?", false)) {
                $this->info("Command aborted");
                exit();
            }

            $this->dropAllTables();
        } else {
            $this->dropTables($tables);
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Drop all tables from database.
     *
     * @return void
     */
    public function dropAllTables()
    {
        Schema::dropAllTables();

        $this->info("All tables dropped.");
    }

    /**
     * Drop specific tables.
     *
     * @param  array $tables
     * @return void
     */
    public function dropTables(array $tables)
    {
        foreach ($tables as $table) {
            $table = trim($table);
            $this->info("Dropping table $table");

            if (Schema::hasTable($table)) {
                Schema::dropIfExists($table);
                $this->warn('Another one bites the dust...');
            } else {
                $this->warn("No table named `$table` found.");
                // break;
            }

            // Remove from migrations table
            $className = strtolower($table)."_table";
            DB::table(config('database.migrations'))->where('migration', 'LIKE', '%'.$className)->delete();
        }
    }
}

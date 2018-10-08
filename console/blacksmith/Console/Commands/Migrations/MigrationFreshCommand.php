<?php

namespace Blacksmith\Console\Commands\Migrations;

use Blacksmith\Support\Console\Command;
use Pluma\Support\Console\Traits\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class MigrationFreshCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migration:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables and re-run all migrations';

    /**
     * The default class to seed the database.
     *
     * @var string
     */
    protected $defaultSeederClass = 'Pluma\Support\Database\DatabaseSeeder';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return;
        }

        $this->dropAllTables(
            $database = $this->input->getOption('database')
        );

        $this->info('Dropped all tables successfully.');

        $this->call('migration:migrate', [
            '--database' => $database,
            '--path' => $this->input->getOption('path'),
            '--force' => true,
        ]);

        if ($this->needsSeeding()) {
            $this->runSeeder($database);
        }
    }

    /**
     * Drop all of the database tables.
     *
     * @param  string  $database
     * @return void
     */
    protected function dropAllTables($database)
    {
        $this->webApp['db']->connection($database)
                    ->getSchemaBuilder()
                    ->dropAllTables();
    }

    /**
     * Determine if the developer has requested database seeding.
     *
     * @return bool
     */
    protected function needsSeeding()
    {
        return $this->option('seed') || $this->option('seeder');
    }

    /**
     * Run the database seeder command.
     *
     * @param  string  $database
     * @return void
     */
    protected function runSeeder($database)
    {
        $this->call('db:seed', [
            '--database' => $database,
            '--class' => $this->option('seeder') ?: $this->defaultSeederClass,
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],

            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],

            ['path', null, InputOption::VALUE_OPTIONAL, 'The path to the migrations files to be executed.'],

            ['realpath', null, InputOption::VALUE_NONE, 'Indicate any provided migration file paths are pre-resolved absolute paths.'],

            ['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'],

            ['seeder', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder.'],
        ];
    }
}

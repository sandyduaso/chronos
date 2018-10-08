<?php

namespace Blacksmith\Console\Commands\Migrations;

use Blacksmith\Console\Commands\Migrations\Support\BaseCommand;
use Illuminate\Support\Facades\File;
use Pluma\Support\Modules\Traits\ModulerTrait;

class MigrationListCommand extends BaseCommand
{
    use ModulerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'migration:list
        {--o|order=c : The table sort order. c = class, m = module}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all migrations';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $n = microtime(true);
        $headers = ['Module', 'Class'];
        $rows = $this->getMigrationClassesAsRows();

        $this->table($headers, $rows);

        $this->info("Took " . $this->time($n) . " to finish the command.");
    }

    /**
     * Retrieves the migrations classes.
     *
     * @return array
     */
    protected function getMigrationClassesAsRows()
    {
        foreach ($this->getMigrationClassesFromFiles() as $module => $files) {
            foreach (collect($files)->sortBy('getFilename') as $i => $file) {
                $rows[] = [
                    'module' => $module,
                    'class' => $file->getFilename(),
                ];
            }
        }

        $sortBy = $this->option('order') == 'c' ? 'class' : 'module';
        return collect($rows)->sortBy($sortBy)->toArray() ?? [];
    }

    /**
     * Retrieves the migrations classes from files.
     *
     * @return array
     */
    protected function getMigrationClassesFromFiles()
    {
        foreach ($this->modules() as $module) {
            if (file_exists($this->getModuleMigrationPath($module))) {
                $files[$module] = File::allFiles($this->getModuleMigrationPath($module));
            }
        }

        return $files ?? [];
    }
}

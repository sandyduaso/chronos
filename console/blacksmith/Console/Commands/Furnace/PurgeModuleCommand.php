<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Exception;

class PurgeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:module
                            {name : The module to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the specified module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $option = $this->option();
        $module = $this->argument('name');

        if ('yes' === $this->ask("Are you sure you want to completely delete the module $module? Type yes if you want to proceed.", 'no')) {
            $this->info("Deleting...");
            if (! $this->delete(get_module($module))) {
                $this->error("Module not found!");
            }
        }

        $this->info("Done.");
    }

    /**
     * Delete the specified module folder and files.
     *
     * @param  string $path
     * @return boolean
     */
    public function delete($path)
    {
        return File::deleteDirectory($path);
    }
}

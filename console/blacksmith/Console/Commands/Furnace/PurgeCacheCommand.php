<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class PurgeCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the framework cache from storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $this->line("Clearing framework cache from /storage/framework/cache...");

        $path = storage_path('framework/cache');

        $this->recursivelyDeleteDirectories($filesystem, glob("$path/*"));

        $this->info("Done.");
    }

    /**
     * Delete the files and directories from the array of paths.
     *
     * @param  array $path
     * @return void
     */
    protected function recursivelyDeleteDirectories(Filesystem $filesystem, $path = [])
    {
        $restrictedFiles = ['.gitignore', '.gitkeep'];

        foreach ($path as $directory) {
            if (is_dir($directory)) {
                $this->recursivelyDeleteDirectories($filesystem, glob("$directory/*"));
                if (! @rmdir($directory)) {
                    $this->warn("Unable to delete directory. Permission denied.");
                }
            } else {
                if (! in_array(basename($directory), $restrictedFiles)) {
                    if (! $filesystem->delete($directory)) {
                        @chmod($directory, 0777);
                        if (! @unlink($directory)) {
                            $this->warn("Unable to delete files. Permission denied.");
                        }
                    }
                }
            }
        }
    }
}

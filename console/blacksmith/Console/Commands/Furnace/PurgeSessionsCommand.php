<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Pluma\Support\Console\Command;

class PurgeSessionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:sessions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the compiled sessions from storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        @session_destroy();
        @session_unset();
        session()->flush();
        session()->regenerate();

        $this->line("Clearing cached views from /storage/framework/sessions...");

        $path = storage_path('framework/sessions');

        $restrictedFiles = ['.gitignore', '.gitkeep'];

        foreach (glob("$path/*") as $file) {
            if (! in_array(basename($file), $restrictedFiles)) {
                $filesystem->delete($file);
            }
        }

        $this->info("Done.");
    }
}

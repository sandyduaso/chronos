<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppPathsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Display the list of app's paths.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['Name', 'URI / Path', 'Function'];

        $body = [
            ["URL", url('/'), 'url($path = "")'],
            ["Base Path", base_path(), 'base_path($path = "")'],
            ["Core Path", core_path(), 'core_path($path = "")'],
            ["Public Path", public_path(), 'public_path($path = "")'],
            ["Modules Path", modules_path(), 'modules_path($path = "")'],
            ["Themes Path", themes_path(), 'themes_path($path = "")'],
            ["Storage Path", storage_path(), 'storage_path($path = "")'],
            ["Database Path", database_path(), 'database_path($path = "")'],
        ];

        $this->table($headers, $body);
    }
}

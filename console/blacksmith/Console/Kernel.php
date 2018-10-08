<?php

namespace Blacksmith\Console;

use Illuminate\Support\Facades\File;
use Pluma\Console\Commands\Scheduling\Schedule;
use Pluma\Console\Kernel as BaseKernel;
use Symfony\Component\Finder\Finder;

class Kernel extends BaseKernel
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    public $commands = [];

    /**
     * Register the console commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(base_path('console/blacksmith/routes/console.php'));

        $this->loadCommandsFromBlacksmithCommands();

        parent::commands();
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        parent::schedule($schedule);
    }

    /**
     * Require a file.
     *
     * @param  string $command
     * @return void
     */
    public function load($command)
    {
        require $command;
    }

    /**
     * Loads the commands from the commands folder.
     *
     * @return void
     */
    protected function loadCommandsFromBlacksmithCommands()
    {
        $path = blacksmith_path('Console/Commands');

        $files = Finder::create()
                       ->files()
                       ->notName('BaseCommand.php')
                       ->name('*Command.php')
                       ->in($path);

        foreach ($files as $file) {
            $command = str_replace($path.DIRECTORY_SEPARATOR, '', $file->getRealPath());
            $command = str_replace(".php", '', $command);
            $command = str_replace(DIRECTORY_SEPARATOR, '\\', $command);

            $this->commands[] = "Blacksmith\\Console\\Commands\\{$command}";
        }
    }
}

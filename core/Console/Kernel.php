<?php

namespace Pluma\Console;

use Pluma\Console\Commands\Scheduling\Schedule;
use Pluma\Support\Console\Kernel as ConsoleKernel;
use Symfony\Component\Finder\Finder;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Pluma\Console\Commands\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->scheduledJobs($schedule);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(core_path('routes/console.php'));

        $this->loadCommandsFromBlacksmithCommands();

        $this->loadCommandsFromCore();

        $this->loadCommandsFromModules();

        $this->loadCommandRoutesFromModules();
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

    /**
     * Get all console commands from modules.
     *
     * @return void
     */
    protected function loadCommandsFromModules()
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/console.php")) {
                $commands = (array) require "$module/config/console.php";
                $this->commands = array_merge((array) $this->commands, (array) $commands);
            }
        }
    }

    /**
     * Get all console route commands from modules.
     *
     * @return void
     */
    protected function loadCommandRoutesFromModules()
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/routes/console.php")) {
                $this->load("$module/routes/console.php");
            }
        }
    }

    /**
     * Get all console commands from core.
     *
     * @return void
     */
    protected function loadCommandsFromCore()
    {
        if (file_exists(core_path('config/console.php'))) {
            $commands = require_once core_path('config/console.php');
            $this->commands = array_merge((array) $this->commands, (array) $commands);
        }
    }

    /**
     * Loads the scheduled commands from modules.
     *
     * @param  \Pluma\Console\Commands\Scheduling\Schedule $schedule
     * @return void
     */
    protected function scheduledJobs(Schedule $schedule)
    {
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/jobs.php")) {
                $jobs = (array) require_once "$module/config/jobs.php";
                foreach ($jobs as $class) {
                    $schedule->job($class['job'], $class['queue']);
                }
            }
        }
    }
}

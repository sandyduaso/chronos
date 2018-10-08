<?php

namespace Blacksmith\Console\Commands\Standalone;

use Blacksmith\Support\Console\Command;
use Illuminate\Support\ProcessUtils;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\PhpExecutableFinder;

class AppServeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function fire()
    {
        chdir($this->webApp->publicPath());

        $host = $this->input->getOption('host');

        $port = $this->input->getOption('port');

        $base = ProcessUtils::escapeArgument($this->webApp->basePath());

        $binary = ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false));

        $this->info("Pluma development server started on http://{$host}:{$port}/");

        passthru("{$binary} -S {$host}:{$port} {$base}/tests/server.php");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.', '127.0.0.1'],

            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.', 8000],
        ];
    }
}

<?php

namespace Blacksmith\Console\Commands\Log;
use Blacksmith\Support\Console\Command;
use Symfony\Component\Process\Process;

class LogTailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:tail
                           {--l|lines=0 : Specify number of lines}
                           {--clear : Clear the terminal}
                           {--f|follow : Follow the log file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tail the latest logfile';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lines = $this->option('lines');
        $path = $this->getLogFile();
        $follow = $this->option('follow') ? '-f' : '';
        $command = "tail {$follow} -n {$lines} " . escapeshellarg($path);

        $this->clear();

        (new Process($command))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->clear();
                $this->output->write($line);
            });
    }

    /**
     * Retrieves the log file.
     *
     * @return string
     */
    protected function getLogFile()
    {
        $channel = config('logging.log');

        return config("logging.channels.{$channel}.path");
    }

    /**
     * Retrieves the log file as
     *
     * @return string
     */
    protected function logFile()
    {
        return $this->getLogFile();
    }

    /**
     * Clear lines.
     *
     * @return void
     */
    protected function clear()
    {
        if (! $this->option('clear')) {
            return;
        }

        $this->output->write(sprintf("\033\143\e[$ ctrl+c to end tail]"));
    }
}

<?php

namespace Pluma\Support\Queue;

use Illuminate\Queue\Listener as BaseListener;
use Illuminate\Support\ProcessUtils;

class Listener extends BaseListener
{
    /**
     * Create a new queue listener.
     *
     * @param  string  $commandPath
     * @return void
     */
    public function __construct($commandPath = null)
    {
        $this->commandPath = $commandPath;
        $this->workerCommand = $this->buildCommandTemplate();
    }

    /**
     * Build the environment specific worker command.
     *
     * @return string
     */
    protected function buildCommandTemplate()
    {
        $command = 'queue:work %s --once --queue=%s --delay=%s --memory=%s --sleep=%s --tries=%s';

        return "{$this->phpBinary()} {$this->blacksmithBinary()} {$command}";
    }

    /**
     * Get the Artisan binary.
     *
     * @return string
     */
    protected function blacksmithBinary()
    {
        return defined('BLACKSMITH_BINARY')
                        ? ProcessUtils::escapeArgument(BLACKSMITH_BINARY)
                        : ProcessUtils::escapeArgument('blacksmith');
    }
}

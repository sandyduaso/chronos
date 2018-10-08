<?php

namespace Tests\Support\Test\Concerns;

use Illuminate\Contracts\Console\Kernel;

trait InteractsWithConsole
{
    /**
     * Call console command and return code.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return int
     */
    public function console($command, $parameters = [])
    {
        return $this->app[Kernel::class]->call($command, $parameters);
    }
}

<?php

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * -----------------------------------------------------------------------------
 * Console Routes
 * -----------------------------------------------------------------------------
 *
 * This file is where you may define all of your Closure based console
 * commands. Each Closure is bound to a command instance allowing a
 * simple approach to interacting with each command's IO methods.
 *
 */

// Sample closure console commands
Artisan::command('pluma:version', function () {
    $this->line("Pluma " . PLUMA_VERSION);
});

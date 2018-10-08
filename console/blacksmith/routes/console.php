<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Helper\Table;
use \Symfony\Component\Process\Exception\ProcessFailedException;
use \Symfony\Component\Process\Process;

/**
 *------------------------------------------------------------------------------
 * Console Routes
 *------------------------------------------------------------------------------
 *
 * This file is where you may define all of your Closure based console
 * commands. Each Closure is bound to a command instance allowing a
 * simple approach to interacting with each command's IO methods.
 *
 */

Artisan::command('quote:someone', function () {
    $this->comment(Collection::make([
        "Simplicity is the ultimate sophistication. - Leonardo da Vinci",
        "It is by no means an irrational fancy that, in a future existence, we shall look upon what we think our present existence, as a dream. - Edgar Allan Poe",
        "Life... is a tale Told by an idiot, full of sound and fury, Signifying nothing. - William Shakespeare, Macbeth",
        "Not all those who wander are lost - J.R.R. Tolkien, The Fellowship of the Ring"
    ])->random());
});

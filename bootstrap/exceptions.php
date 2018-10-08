<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
// ...add more, even custom ones.

// Set Whoops as the default error and exception handler used by PHP:
$whoops->register();

// Uncomment line below to test if Whoops is working.
// throw new RuntimeException("Oopsie!");

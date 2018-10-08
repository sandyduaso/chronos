<?php

namespace Pluma\Support\Log;

use Illuminate\Log\LogManager as BaseLogManager;
use Illuminate\Log\Logger;
use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;

class LogManager extends BaseLogManager
{
    /**
     * Create an emergency log handler to avoid white screens of death.
     *
     * @return \Psr\Log\LoggerInterface
     */
    protected function createEmergencyLogger()
    {
        return new Logger(new Monolog('pluma', $this->prepareHandlers([new StreamHandler(
                $this->app->storagePath().'/logs/app.log', $this->level(['level' => 'debug'])
        )])), $this->app['events']);
    }
}

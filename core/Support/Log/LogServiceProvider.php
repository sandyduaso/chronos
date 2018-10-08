<?php

namespace Pluma\Support\Log;

use Illuminate\Log\LogServiceProvider as BaseLogServiceProvider;
use Pluma\Support\Log\LogManager;

class LogServiceProvider extends BaseLogServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('log', function () {
            return new LogManager($this->app);
        });
    }
}

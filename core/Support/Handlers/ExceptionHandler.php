<?php

namespace Pluma\Support\Handlers;

trait ExceptionHandler
{
    /**
     * Register Exception handlers
     *
     * @return void
     */
    public function registerExceptionHandlers()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Pluma\Exceptions\Handler::class
        );
    }
}

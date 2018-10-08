<?php

namespace Pluma\Support\Queue;

use Illuminate\Queue\QueueServiceProvider as BaseQueueServiceProvider;
use Pluma\Support\Queue\Listener;

class QueueServiceProvider extends BaseQueueServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Register the queue listener.
     *
     * @return void
     */
    protected function registerListener()
    {
        $this->app->singleton('queue.listener', function () {
            return new Listener($this->app->basePath());
        });
    }
}

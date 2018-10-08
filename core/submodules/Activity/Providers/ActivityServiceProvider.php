<?php

namespace Activity\Providers;

use Pluma\Support\Providers\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Activity\Models\Activity::class, '\Activity\Observers\ActivityObserver'],
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        //
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $path = get_module('activity');
        if (file_exists("$path/helpers/helpers.php")) {
            require "$path/helpers/helpers.php";
        }
    }
}

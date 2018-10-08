<?php

namespace Menu\Providers;

use Pluma\Support\Providers\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Menu\Models\Menu::class, '\Menu\Observers\MenuObserver'],
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
        // $this->bootComposers();

        $this->bootObservables();

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boots the composers variable
     *
     * @return void
     */
    public function bootComposers()
    {
        if (file_exists(__DIR__."/../config/composers.php")) {
            $this->composers = require_once __DIR__."/../config/composers.php";
        }
    }
}

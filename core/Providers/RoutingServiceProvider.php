<?php

namespace Pluma\Providers;

use Pluma\Support\Facades\Route;
use Pluma\Support\Route\RoutingServiceProvider as ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Pluma\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }


    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAssetsRoutes();

        $this->mapStorageRoutes();

        $this->mapFuzzyRoutes();

        $this->mapWebRoutes();

        $this->mapPublicRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        if (file_exists(core_path('routes/api.php'))) {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(core_path('routes/api.php'));
        }
    }

    /**
     * Define the "assets" routes for the application.
     *
     * These routes are typically for assets fetching.
     *
     * @return void
     */
    protected function mapAssetsRoutes()
    {
        if (file_exists(core_path('routes/assets.php'))) {
            Route::middleware('web')
                ->group(core_path('routes/assets.php'));
        }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        if (file_exists(core_path('routes/web.php'))) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(core_path('routes/web.php'));
        }
    }

    /**
     * Define the "storage" routes for the application.
     *
     * These routes are typically for fetching resource from the
     * local storage folder.
     *
     * @return void
     */
    protected function mapStorageRoutes()
    {
        if (file_exists(core_path('routes/storage.php'))) {
            Route::middleware('web')
                ->group(core_path('routes/storage.php'));
        }
    }

    /**
     * Define the "fuzzy" routes for the application.
     *
     * These routes are typically for assets fetching.
     *
     * @return void
     */
    protected function mapFuzzyRoutes()
    {
        if (file_exists(core_path('routes/fuzzy.php'))) {
            Route::middleware('web')
                ->group(core_path('routes/fuzzy.php'));
        }
    }

    /**
     * Define the public routes for the application.
     *
     * These routes are typically not authenticated.
     *
     * @return void
     */
    protected function mapPublicRoutes()
    {
        if (file_exists(core_path('routes/public.php'))) {
            Route::middleware('web')
                ->group(core_path('routes/public.php'));
        }
    }
}

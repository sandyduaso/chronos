<?php

namespace Pluma\Support\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Array of view composers to register.
     *
     * @var array
     */
    protected $composers = [
        //
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
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [
        //
    ];

    /**
     * Array of factories path to register.
     *
     * @var array
     */
    protected $factories = [
        //
    ];

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();

        $this->bootPolicies();

        $this->bootRouterMiddlewares();

        $this->bootViewComposers();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

        $this->registerEloquentFactories();
    }

    /**
     * Bootstraps the Observables.
     *
     * @return void
     */
    public function bootObservables()
    {
        foreach ($this->observables() as $observable) {
            if (Schema::hasTable(with($this->app->make($observable[0]))->getTable())) {
                $model = $this->app->make($observable[0]);
                $observer = $this->app->make($observable[1]);
                $model::observe(new $observer);
            }
        }
    }

    /**
     * Boots the router middleware
     *
     * @return void
     */
    public function bootRouterMiddlewares()
    {
        $this->router = $this->app['router'];

        foreach ($this->middlewares() as $middleware) {
            $this->router->aliasMiddleware($middleware['alias'], $middleware['class']);
        }
    }

    /**
     * Boots the view composers.
     *
     * @return void
     */
    public function bootViewComposers()
    {
        $composers = (array) $this->composers;

        foreach ($composers as $composer) {
            view()->composer($composer['appears'], $composer['class']);
        }
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function bootPolicies()
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    /**
     * Gets the array of observables.
     *
     * @return array
     */
    public function observables()
    {
        return $this->observables;
    }

    /**
     * Gets the array of middlewares.
     *
     * @return array
     */
    public function middlewares()
    {
        return $this->middlewares;
    }

    /**
     * Register additional Providers through this Provider.
     *
     * @return void
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register array of factories.
     *
     * @return void
     */
    protected function registerEloquentFactories()
    {
        foreach ($this->factories as $factoryPath) {
            $this->registerEloquentFactoriesFrom($factoryPath);
        }
    }

    /**
     * Register Eloquent Factories.
     *
     * @param string $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}

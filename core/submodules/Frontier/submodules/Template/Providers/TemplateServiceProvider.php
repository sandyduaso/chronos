<?php

namespace Template\Providers;

use Pluma\Support\Providers\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider
{
    protected $viewNamespace = "Template";

    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        // [\Template\Models\Template::class, '\Template\Observers\TemplateObserver'],
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
        $this->bootObservables();

        $this->bootViewNamespaces();
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
     * Boot view namespaces.
     *
     * @return void
     */
    public function bootViewNamespaces()
    {
        $templateModule = get_module('template');
        $templateTheme = themes_path(settings('active_theme'), 'default');
        $this->loadViewsFrom("$templateTheme/views/templates", $this->viewNamespace);
        $this->loadViewsFrom("$templateModule/views/templates", $this->viewNamespace);
    }
}

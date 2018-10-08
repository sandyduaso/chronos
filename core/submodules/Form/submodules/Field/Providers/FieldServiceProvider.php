<?php

namespace Field\Providers;

use Pluma\Support\Providers\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Field\Models\Field::class, '\Field\Observers\FieldObserver'],
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
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Field\Models\Field::class => \Field\Policies\FieldPolicy::class,
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
        //
    }
}

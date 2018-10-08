<?php

namespace Submission\Providers;

use Pluma\Support\Providers\ServiceProvider;
use Submission\Models\Submission;
use Submission\Policies\SubmissionPolicy;

class SubmissionServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Submission\Models\Submission::class, '\Submission\Observers\SubmissionObserver'],
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Submission::class => SubmissionPolicy::class,
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
        //
    }
}

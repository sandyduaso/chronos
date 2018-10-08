<?php

namespace Page\Providers;

use Page\Models\Page;
use Page\Policies\PagePolicy;
use Pluma\Support\Providers\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Page\Models\Page::class, '\Page\Observers\PageObserver'],
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Page::class => PagePolicy::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootComposers();

        parent::boot();
    }

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
     * Boots the composers variable
     *
     * @return void
     */
    public function bootComposers()
    {
        $path = get_module('page') . '/config/composers.php';

        if (file_exists($path)) {
            $this->composers = require_once realpath($path);
        }
    }
}

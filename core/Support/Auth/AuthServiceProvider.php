<?php

namespace Pluma\Support\Auth;

use Illuminate\Support\Facades\Gate;
use Pluma\Support\Providers\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }
}

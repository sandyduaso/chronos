<?php

namespace Profile\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Pluma\Support\Providers\ServiceProvider;
use User\Models\User;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        [
        	'alias' => 'user.profile',
        	'class' => \Profile\Middleware\ProfileMiddleware::class
        ],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootValidators();
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
     * Register new validators.
     *
     * @return void
     */
    public function bootValidators()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            $user = User::find(current($parameters));

            return Hash::check($value, $user->password);
        });

        Validator::replacer('old_password', function ($message, $attribute, $rule, $parameters) {
            return "Old password mismatch";
        });
    }
}

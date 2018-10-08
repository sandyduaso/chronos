<?php

namespace User\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Pluma\Support\Providers\ServiceProvider;
use User\Models\User;

class PasswordServiceProvider extends ServiceProvider
{
    /**
     * Will make sure that the required modules have been fully loaded
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootValidators();
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

<?php

namespace Pluma\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\AggregateServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Pluma\Providers\QueueServiceProvider;

class ApplicationServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        FormRequestServiceProvider::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerRequestValidation();

        $this->registerRequestSignatureValidation();

        $this->registerApplicationMacros();
    }

    /**
     * Register the "validate" macro on the request.
     *
     * @return void
     */
    public function registerRequestValidation()
    {
        Request::macro('validate', function (array $rules, ...$params) {
            validator()->validate($this->all(), $rules, ...$params);

            return $this->only(collect($rules)->keys()->map(function ($rule) {
                return Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
            })->unique()->toArray());
        });
    }

    /**
     * Register the "hasValidSignature" macro on the request.
     *
     * @return void
     */
    public function registerRequestSignatureValidation()
    {
        Request::macro('hasValidSignature', function () {
            return URL::hasValidSignature($this);
        });
    }

    /**
     * Register collection macros.
     *
     * @return void
     */
    public function registerApplicationMacros()
    {
        Collection::macro('recurse', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return collect($value)->recurse();
                }
                return $value;
            });
        });
    }
}

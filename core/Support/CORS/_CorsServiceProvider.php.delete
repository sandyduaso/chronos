<?php

namespace Pluma\Support\CORS;

use Pluma\Http\Kernel;
use Pluma\Support\CORS\Middleware\CORS;
use Pluma\Support\CORS\Middleware\Preflight;
use Pluma\Support\Providers\ServiceProvider;

class CorsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(config_path('cors.php'), 'cors');

        $this->app->singleton(CorsService::class, function ($app) {
            $options = $app['config']->get('cors');

            if (isset($options['allowedOrigins'])) {
                foreach ($options['allowedOrigins'] as $origin) {
                    if (strpos($origin, '*') !== false) {
                        $options['allowedOriginsPatterns'][] = $this->convertWildcardToPattern($origin);
                    }
                }
            }

            return new CorsService($options);
        });
    }

    /**
     * Add the Cors middleware to the router.
     *
     */
    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);

        // When the HandleCors middleware is not attached globally, add the PreflightCheck
        if (! $kernel->hasMiddleware(CORS::class)) {
            $kernel->prependMiddleware(Preflight::class);
        }
    }

    /**
     * Create a pattern for a wildcard, based on Str::is() from Laravel
     *
     * @see https://github.com/laravel/framework/blob/5.5/src/Illuminate/Support/Str.php
     * @param $pattern
     * @return string
     */
    protected function convertWildcardToPattern($pattern)
    {
        $pattern = preg_quote($pattern, '#');
        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern);
        return '#^'.$pattern.'\z#u';
    }
}

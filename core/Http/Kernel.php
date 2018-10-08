<?php

namespace Pluma\Http;

use Pluma\Support\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Pluma\Middleware\Localization::class,
        \Pluma\Middleware\TrimStrings::class,
        \Pluma\Support\Http\Middleware\CheckForMaintenanceMode::class,
        \Pluma\Support\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Pluma\Support\Http\Middleware\VerifyPostSize::class,
        \Pluma\Support\CORS\Middleware\CORS::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Pluma\Middleware\AuthenticateSession::class,
            \Pluma\Middleware\EncryptCookies::class,
            \Pluma\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:80,1',
            'bindings',
            'preflight',
            'cors',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Pluma\Support\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'cors' => \Pluma\Support\CORS\Middleware\CORS::class,
        'guest' => \Pluma\Middleware\RedirectIfAuthenticated::class,
        'preflight' => \Pluma\Support\CORS\Middleware\Preflight::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}

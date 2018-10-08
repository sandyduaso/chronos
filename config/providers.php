<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Service Providers
     *--------------------------------------------------------------------------
     *
     * Array of all base service providers needed to run the application.
     *
     */
    'providers' => [
        // Vendor
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,

        // View First
        Pluma\Providers\ViewServiceProvider::class,

        // Application
        Pluma\Providers\ApplicationServiceProvider::class,
        Pluma\Providers\DatabaseServiceProvider::class,
        Pluma\Providers\EventServiceProvider::class,
        Pluma\Providers\TranslationServiceProvider::class,
        Pluma\Providers\ModuleServiceProvider::class,
        Pluma\Providers\FormRequestServiceProvider::class,

        /**
         * Support
         *
         * Overrides vendor Service Providers
         *
         */
        Pluma\Support\Queue\QueueServiceProvider::class,
        Pluma\Support\Broadcasting\BroadcastRouteServiceProvider::class,
        Pluma\Support\Encryption\EncryptionServiceProvider::class,
        // TODO: Pluma\Support\CORS\CorsServiceProvider::class,
        // Pluma\Support\Installation\Providers\InstallationServiceProvider::class,

        // Console
        Blacksmith\Providers\ConsoleSupportServiceProvider::class,
    ],

    /**
     *--------------------------------------------------------------------------
     * Aliases
     *--------------------------------------------------------------------------
     *
     * Here we register the application Facades.
     * The main Facade for the app's instance is `App`.
     *
     */
    'aliases' => [
        // Pluma
        'Console' => Pluma\Support\Facades\Console::class,
        'Route' => Pluma\Support\Facades\Route::class,
        'Blacksmith' => Blacksmith\Support\Facades\Blacksmith::class,

        // Illuminate
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
    ],
];

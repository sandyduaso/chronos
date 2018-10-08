<?php

return [

    /**
     *--------------------------------------------------------------------------
     * Default Log Channel
     *--------------------------------------------------------------------------
     *
     * This option defines the default log channel that gets used when writing
     * messages to the logs. The name specified in this option should match
     * one of the channels defined in the "channels" configuration array.
     *
     */

    'default' => env('LOG_CHANNEL', 'stack'),

    /**
     *--------------------------------------------------------------------------
     * Log Channels
     *--------------------------------------------------------------------------
     *
     * Here you may configure the log channels for your application. Out of
     * the box, the app uses the Monolog PHP logging library. This gives
     * you a variety of powerful log handlers / formatters to utilize.
     *
     * Available Drivers: "single", "daily", "slack", "syslog",
     *                    "errorlog", "custom", "stack"
     *
     */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/app.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/app.log'),
            'level' => 'debug',
            'days' => 7,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'App Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],

    /**
     *--------------------------------------------------------------------------
     * Logging Configuration
     *--------------------------------------------------------------------------
     *
     * Here you may configure the log settings for your application. Out of
     * the box, the application uses the Monolog PHP logging library. This gives
     * you a variety of powerful log handlers / formatters to utilize.
     *
     * Available Settings: "single", "daily", "syslog", "errorlog"
     *
     */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),
];

<?php

return [
    /**
     *--------------------------------------------------------------------------
     * List of some settings keyword
     *--------------------------------------------------------------------------
     *
     * The following settings keywords are used as defaults
     * when installing the app.
     *
     */
    'active_theme' => 'default',
    'default_theme' => 'default',
    'social_links' => '',

    // Site Settings
    'site_language' => 'en',
    'site_title' => env('APP_NAME', 'Pluma CMS'),
    'site_tagline' => env('APP_TAGLINE', ''),

    // Dates
    'date_format' => 'Y-m-d',
    'time_format' => 'H:i:s',
    'js_date_format' => 'YYYY-MM-DD',
    'js_time_format' => 'LT',
];

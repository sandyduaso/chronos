<?php

Route::get('js/main.js', function () {
    // User
    $user = [
        'user' => [
            'user' => ! user() ?: user()->only(['firstname', 'middlename', 'lastname', 'fullname', 'propername', 'email', 'username']),
            'isRoot' => ! user() ?: user()->isRoot(),
            'permissions' => ! user() ?: user()->permissions->pluck('code'),
        ]
    ];

    // Language
    Cache::forget('languages.js');
    $languages = Cache::rememberForever('languages.js', function () {
        $lang = settings('site_language', config('language.locale', 'en'));
        $files = glob(resource_path("lang/$lang/*.php"));

        foreach ($files as $file) {
            $name = basename($file, '.php');
            $languages[$name] = require $file;
        }

        return $languages ?? [];
    });

    $send = 'window.i18n = ' . json_encode($languages) . ';';
    $send .= 'window.Pluma=' . json_encode($user) . ';';

    $headers = [
        'Cache-Control' => 'public',
        'Content-Type' => 'text/javascript',
    ];

    return response()
            ->make($send, 200)
            ->withHeaders($headers);
});

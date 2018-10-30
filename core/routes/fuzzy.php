<?php

use Illuminate\Support\Facades\File;

Route::get('themes/{file?}', function ($file = null) {
    $activeTheme = settings('active_theme', 'default') ?? 'default';
    $path = $activeTheme === 'default'
        ? core_path('theme')
        : themes_path($activeTheme);
    $path = $path.'/'.$file;
    $extension = File::extension($path);
    $contentType = config("mimetypes.$extension", 'txt');

    if (in_array($extension, config('download.restricted', []))) {
        return abort(403);
    }

    if (! File::exists($path)) {
        $path = core_path("theme/{$file}");
    }

    if (File::exists($path)) {
        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);
})->where('file', '.*');

Route::get('anytheme/{file?}', function ($file = null) {
    $url = explode('/', $file);
    $theme = array_shift($url);
    $url = implode('/', $url);
    $path = $theme === 'default'
        ? core_path('theme')
        : themes_path().'/'.$theme;
    $path = $path.'/'.$url;

    $extension = File::extension($path);
    $contentType = config("mimetypes.$extension", 'txt');

    if (! in_array($extension, config('download.assets', []))) {
        return abort(404);
    }

    if (! File::exists($path)) {
        $path = core_path("theme/{$file}");
    }

    if (File::exists($path)) {
        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);
})->where('file', '.*');

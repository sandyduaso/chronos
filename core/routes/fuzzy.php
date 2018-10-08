<?php

use Illuminate\Support\Facades\File;

Route::get('themes/{file?}', function ($file = null) {
    $path = themes_path(settings('active_theme', 'default')."/$file");
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
    $path = themes_path("$file");
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

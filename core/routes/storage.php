<?php

use Illuminate\Support\Facades\File;

/**
 * -----------------------------------------------------------------------------
 * Storage Routes
 * -----------------------------------------------------------------------------
 *
 * This file is where you may define all of your Assets based urls.
 *
 */

Route::get('storage/{file?}', function ($file = '/') {
    $path = storage_path(urldecode($file));
    $extension = File::extension($path);

    if (in_array($extension, config('download.restricted', []))) {
        return abort(403);
    }

    if (File::exists($path)) {
        $contentType = config("mimetypes.$extension", 'txt');

        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);
})->where('file', '.*');

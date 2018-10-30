<?php

Route::prefix('appearance')->middleware(['breadcrumbs:\Theme\Models\Theme'])->group(function () {
    // Upload
    Route::post('themes/upload', 'ThemeController@upload')->name('themes.upload');

    // List
    Route::get('themes/{preview}/preview', 'ThemeController@show')->name('themes.preview');
    Route::get('themes', 'ThemeController@index')->name('themes.index');
});


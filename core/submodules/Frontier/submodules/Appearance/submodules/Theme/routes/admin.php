<?php

// Upload
Route::post('appearance/themes/upload', 'ThemeController@upload')->name('themes.upload');

// List
Route::get('appearance/themes/{preview}/preview', 'ThemeController@preview')->name('themes.preview');
Route::get('appearance/themes', 'ThemeController@index')->name('themes.index');

<?php

Route::get('welcome', '\Pluma\Support\Installation\Controllers\InstallController@index')->name("installation.welcome");

Route::get('welcome/setup', '\Pluma\Support\Installation\Controllers\InstallController@getSetupForm')->name("installation.setup.form");

Route::post('welcome/setup', '\Pluma\Support\Installation\Controllers\InstallController@setup')->name("installation.setup");

Route::get('welcome/seed', '\Pluma\Support\Installation\Controllers\InstallController@getSeedForm')->name("installation.seed.form");

Route::post('welcome/store', '\Pluma\Support\Installation\Controllers\InstallController@store')->name("installation.store");

Route::get('welcome/last', '\Pluma\Support\Installation\Controllers\InstallController@last')->name("installation.last");

Route::post('welcome/clean', '\Pluma\Support\Installation\Controllers\InstallController@clean')->name("installation.clean");

Route::post('welcome/migrate', '\Pluma\Support\Installation\Controllers\InstallController@migrate')->name("installation.migrate");

Route::get('app/documentation', '\Pluma\Support\Installation\Controllers\InstallController@index')->name('installation.documentation');

Route::get('{slug?}', function ($slug = null) {
    return redirect()->route('installation.welcome');
})->where('slug', '.*');

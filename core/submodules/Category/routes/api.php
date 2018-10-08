<?php

/**
 * -----------------------------------------------------------------------------
 * API Category Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('categories/{type}/all', 'CategoryController@getAll')->name('categories.all');

    Route::get('categories/{type}/find', 'CategoryController@postFind')->name('categories.find');
    Route::get('categories/{type}/search', 'CategoryController@postFind')->name('categories.search');

    Route::get('categories/{type}/{category}', 'CategoryController@getShow')->name('categories.show');
});

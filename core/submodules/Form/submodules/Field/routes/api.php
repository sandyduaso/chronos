<?php

/**
 * -----------------------------------------------------------------------------
 * Support\Traits Field Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('fields/all', 'FieldController@getAll')->name('fields.all');

    Route::get('fields/find', 'FieldController@postFind')->name('fields.find');
    Route::get('fields/search', 'FieldController@postFind')->name('fields.search');

    Route::get('fields/{field}', 'FieldController@getShow')->name('fields.show');

    // Route::post('fields/{field}', 'FieldController@getRestore')->name('fields.restore');
});

<?php

/**
 * -----------------------------------------------------------------------------
 * API Form Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('forms/all', 'FormController@getAll')->name('forms.all');

    Route::get('forms/find', 'FormController@postFind')->name('forms.find');
    Route::get('forms/search', 'FormController@postFind')->name('forms.search');

    Route::get('forms/media', 'FormController@getMedia')->name('forms.media');

    Route::get('forms/{form}', 'FormController@getShow')->name('forms.show');

    // Route::post('forms/{form}', 'FormController@getRestore')->name('forms.restore');
});

<?php

/**
 * -----------------------------------------------------------------------------
 * API Fieldtype Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('fieldtypes/all', 'FieldtypeController@getAll')->name('fieldtypes.all');

    Route::get('fieldtypes/find', 'FieldtypeController@postFind')->name('fieldtypes.find');
    Route::get('fieldtypes/search', 'FieldtypeController@postFind')->name('fieldtypes.search');

    Route::get('fieldtypes/{fieldtype}', 'FieldtypeController@getShow')->name('fieldtypes.show');

    // Route::post('fieldtypes/{fieldtype}', 'FieldtypeController@getRestore')->name('fieldtypes.restore');
});

<?php

/**
 *------------------------------------------------------------------------------
 * API Routes
 *------------------------------------------------------------------------------
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('profile/upload/all', 'ProfileController@getAll')->name('profile.upload.all');
    Route::post('profile/{profile}/upload', 'ProfileController@postUpload')->name('profile.upload.upload');
});

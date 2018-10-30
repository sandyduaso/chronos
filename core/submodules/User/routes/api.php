<?php

/**
 *------------------------------------------------------------------------------
 * User API Routes
 *------------------------------------------------------------------------------
 *
 * The API routes for users.
 *
 */

Route::prefix('v1')->group(function () {
    Route::get('users/all', 'UserController@getAll')->name('users.all');
    Route::get('users/find', 'UserController@postFind')->name('users.find');
    Route::get('users/search', 'UserController@postFind')->name('users.search');
    Route::get('users/{user}', 'UserController@getShow')->name('users.show');
    Route::post('users/save', 'UserController@postStore')->name('users.save');
    Route::post('users/store', 'UserController@postStore')->name('users.store');
    Route::delete('users/{user}/destroy', 'UserController@deleteDestroy')->name('users.destroy');
});

/**
 *------------------------------------------------------------------------------
 * Login Api Route
 *------------------------------------------------------------------------------
 *
 * The api login route.
 *
 */
Route::prefix('v1')->group(function () {
    Route::post('login', 'LoginApiController@login');
});

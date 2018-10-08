<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Page Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

Route::post('{type}/categories', 'CategoryController@store')->name('categories.store');
Route::put('{type}/categories', 'CategoryController@update')->name('categories.update');

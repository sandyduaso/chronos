<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Field Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('forms/fields/trashed', 'FieldController@trashed')
     ->name('fields.trashed');

Route::patch('forms/fields/restore/{field}', 'FieldController@restore')
     ->name('fields.restore');

Route::delete('forms/fields/delete/{field}', 'FieldController@delete')
     ->name('fields.delete');

// Admin routes
Route::resource('forms/fields', 'FieldController');

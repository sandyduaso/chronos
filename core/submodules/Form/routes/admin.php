<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Form Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('forms/trashed', 'FormController@trashed')
     ->name('forms.trashed');

Route::patch('forms/restore/{form}', 'FormController@restore')
     ->name('forms.restore');

Route::delete('forms/delete/{form}', 'FormController@delete')
     ->name('forms.delete');

// Admin routes
Route::resource('forms', 'FormController');

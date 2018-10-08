<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Fieldtype Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('fieldtypes/trashed', 'FieldtypeController@trashed')
     ->name('fieldtypes.trashed');

Route::patch('fieldtypes/restore/{fieldtype}', 'FieldtypeController@restore')
     ->name('fieldtypes.restore');

Route::delete('fieldtypes/delete/{fieldtype}', 'FieldtypeController@delete')
     ->name('fieldtypes.delete');

// Admin routes
Route::resource('forms/fieldtypes', 'FieldtypeController');

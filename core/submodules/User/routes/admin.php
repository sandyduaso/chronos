<?php

/**
 *------------------------------------------------------------------------------
 * Admin User Route
 *------------------------------------------------------------------------------
 *
 */

// Route::get('users/{id}/password/change', 'PasswordController@getChangeForm')->name('password.change.form');
// Route::post('users/password/change/{id}', 'PasswordController@change')->name('password.change');
// Route::delete('users/delete/many', 'UserManyController@delete')->name('users.many.delete');
// Route::delete('users/delete/{user}', 'UserController@delete')->name('users.delete');
// Route::delete('users/destroy/many', 'UserManyController@destroy')->name('users.many.destroy');
// Route::get('users/refresh', 'UserRefreshController@index')->name('users.refresh.index');
// Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
// Route::post('users/refresh', 'UserRefreshController@refresh')->name('users.refresh.refresh');
// Route::post('users/restore/many', 'UserManyController@restore')->name('users.many.restore');

Route::softDeletes('users', 'UserController', ['trashed' => 'deactivated']);

Route::post('users/export/{user?}', 'UserController@export')->name('users.export');

Route::resource('users', 'UserController', ['middleware' => 'breadcrumbs:\User\Models\User']);

<?php

/**
 *------------------------------------------------------------------------------
 * Admin Profile Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes for profile.
 *
 */

Route::group(['middleware' => 'user.profile'], function () {
	// Credentials Management
	Route::get('profile/{handle}/credentials', 'CredentialController@edit')->name('credentials.edit');
	Route::put('profile/{profile}/credentials', 'CredentialController@update')->name('credentials.update');
	// Email
	Route::get('profile/{handle}/emails', 'EmailController@edit')->name('profile.emails.edit');
	Route::put('profile/{profile}/emails', 'EmailController@update')->name('profile.emails.update');

	// Redirect
	Route::get('profile', function () {
	    return redirect()->route('profile.show', user()->handlename);
	})->name('profile.index');

	// Profile Management
	Route::get('profile/{handle}', 'ProfileController@show')->name('profile.show');
	Route::get('profile/{handle}/edit', 'ProfileController@edit')->name('profile.edit');
	Route::put('profile/{handle}', 'ProfileController@update')->name('profile.update');
});


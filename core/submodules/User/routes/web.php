<?php
/**
 *------------------------------------------------------------------------------
 * Login/logout route
 *------------------------------------------------------------------------------
 *
 * The route of the authentication links.
 *
 */
Route::get('login', 'LoginController@showLoginForm')->name('login.show');
Route::post('login', 'LoginController@login')->name('login.login');

Route::get('logout', 'LoginController@logout')->name('logout.logout');
Route::post('logout', 'LoginController@logout')->name('logout.logout');

Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show');
Route::get('registered/{token}', 'RegisterController@showRegisteredPage')->name('register.registered');
Route::post('register', 'RegisterController@register')->name('register.register');

/**
 *------------------------------------------------------------------------------
 * Password reset route
 *------------------------------------------------------------------------------
 *
 * The route of the password recovery pages.
 *
 */
Route::group(['prefix' => 'authentications/password'], function () {
    Route::get('{user}/verify/{token}', 'VerifyUserController@verify')->name('user.verify');
    // Forgot Password Form
    Route::get('forgot', 'ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
    Route::post('sent', 'ForgotPasswordController@sendResetLinkEmail')->name('password.send');

    Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.token');
    Route::post('reset', 'ResetPasswordController@reset')->name('password.reset');
});

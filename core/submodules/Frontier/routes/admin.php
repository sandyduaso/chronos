<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Routes
 * -----------------------------------------------------------------------------
 *
 * Here is the default admin route that will redirect the user to it's intended
 * route once the user logs in.
 *
 */

Route::get('/', function () {
    return redirect()->intended(route('dashboard'));
})->name('admin');

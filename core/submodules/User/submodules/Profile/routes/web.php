<?php

/**
 * -----------------------------------------------------------------------------
 * Public Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes.
 *
 */

Route::get('u/@{handlename}', 'ProfileController@single')->name('profile.single');

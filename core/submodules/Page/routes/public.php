<?php

/**
 * -----------------------------------------------------------------------------
 * Public Page Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::get('{slug?}', 'PageController@single')
     ->where('slug', '.*');

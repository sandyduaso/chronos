<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Page Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

Route::middleware(['breadcrumbs:\Category\Models\Category'])->group(function () {
    Route::softDeletes('categories', 'CategoryController');
    Route::resource('categories', 'CategoryController');
});

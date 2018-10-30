<?php

/**
 *------------------------------------------------------------------------------
 * Admin Page Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// Category routes
// Route::resource('pages/categories', 'CategoryController', [
//         'except' => ['show', 'create'],
//         'as' => 'pages',
//     ]);

// SoftDelete routes
Route::middleware(['breadcrumbs:\Page\Models\Page'])->group(function () {
    Route::softDeletes('pages', 'PageController');
    Route::resource('pages', 'PageController');
});

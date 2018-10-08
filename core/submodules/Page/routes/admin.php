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
Route::softDeletes('pages', 'PageController', ['module' => 'Pluma']);

// Admin routes
// Route::get('pages', ['component' => 'components/Pluma/Page/Index.vue', 'uses' => 'PageController@index'])->name('pages.index');
// Route::get('pages/create', ['component' => 'components/Pluma/Page/Create.vue', 'uses' => 'PageController@create'])->name('pages.create');
// Route::get('pages/{page}/edit', ['component' => 'components/Pluma/Page/Edit.vue', 'uses' => 'PageController@edit'])->name('pages.edit');
// Route::get('pages/{page}', ['component' => 'components/Pluma/Page/Show.vue', 'uses' => 'PageController@show'])->name('pages.show');
// Route::delete('pages/{page}', ['uses' => 'PageController@destroy'])->name('pages.destroy');
Route::resource('pages', 'PageController', ['module' => 'Pluma']);

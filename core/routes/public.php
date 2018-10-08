<?php


$modules = get_modules_path();

foreach ($modules as $module) {
    $basename = basename($module);

    Route::group(['namespace' => "$basename\Controllers"], function () use ($module) {
        include_file($module, "routes/public.php");
    });
}

// Route::get('{slug?}', 'Pluma\Controllers\AppController@render')
//     ->where('slug', '.*');

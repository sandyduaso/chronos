<?php

Route::get(config('path.dashboard', 'dashboard'), [
    'uses' => 'DashboardController@index',
    // 'component' => 'Pluma/Dashboard/Dashboard'
])->name('dashboard');

<?php

Route::post('widgets/refresh', 'WidgetController@refresh')->name('widgets.refresh');
Route::resource('widgets', 'WidgetController')->only(['index', 'edit', 'update', 'show']);

<?php

Route::softDeletes('timesheets', 'TimesheetController');

Route::post('timesheets/export', 'TimesheetController@export')->name('timesheets.export');

Route::post('timesheets/preview', 'TimesheetController@preview')->name('timesheets.preview');
Route::post('timesheets/upload', 'TimesheetController@upload')->name('timesheets.upload');
Route::post('timesheets/process', 'TimesheetController@process')->name('timesheets.process');

Route::resource('timesheets', 'TimesheetController', ['middleware' => 'breadcrumbs:\Timesheet\Models\Timesheet']);

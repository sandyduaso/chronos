<?php

Route::middleware(['breadcrumbs:\Timesheet\Models\Timesheet'])->group(function () {
    # TimesheetSoftDeleteResource
    Route::softDeletes('timesheets', 'TimesheetController');

    # TimesheetUploadResource
    Route::post('timesheets/export', 'TimesheetController@export')->name('timesheets.export');
    Route::post('timesheets/preview', 'TimesheetController@preview')->name('timesheets.preview');
    Route::post('timesheets/upload', 'TimesheetController@upload')->name('timesheets.upload');
    Route::post('timesheets/process', 'TimesheetController@process')->name('timesheets.process');

    # TimesheetAdminResource
    Route::resource('timesheets', 'TimesheetController');
});

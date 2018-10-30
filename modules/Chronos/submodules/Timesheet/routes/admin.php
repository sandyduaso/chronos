<?php

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Timesheet\Repositories\TimesheetRepository;

Route::middleware(['breadcrumbs:\Timesheet\Models\Timesheet'])->group(function () {
    # TimesheetSettingsController
    Route::get('timesheets/settings', 'TimesheetSettingsController@index')->name('timesheets.settings');

    # TimesheetSoftDeleteResource
    Route::softDeletes('timesheets', 'TimesheetController');

    # TimesheetUploadResource
    Route::post('timesheets/preview', 'TimesheetController@preview')->name('timesheets.preview');
    Route::post('timesheets/upload', 'TimesheetController@upload')->name('timesheets.upload');
    Route::post('timesheets/process', 'TimesheetController@process')->name('timesheets.process');

    # TimesheetExportResource
    Route::post('timesheets/export/{timesheet?}', 'TimesheetController@export')->name('timesheets.export');

    # TimesheetAdminResource
    Route::resource('timesheets', 'TimesheetController');
});

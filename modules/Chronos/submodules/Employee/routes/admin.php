<?php

Route::middleware(['breadcrumbs:\User\Models\User'])->prefix('office')->group(function () {
    Route::post('employees/export', 'EmployeeController@export')->name('employees.export');
    Route::post('employees/import', 'EmployeeController@import')->name('employees.import');
    Route::softDeletes('employees', 'EmployeeController');
    Route::resource('employees', 'EmployeeController');

    Route::resource('departments', 'DepartmentController');
});

<?php

Route::middleware(['breadcrumbs:\User\Models\User'])->prefix('office')->group(function () {
    Route::softDeletes('employees', 'EmployeeController');
    Route::resource('employees', 'EmployeeController');

    Route::resource('departments', 'DepartmentController');
});

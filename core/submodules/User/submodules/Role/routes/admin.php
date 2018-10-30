<?php

use User\Models\User;

Route::prefix('users')->middleware(['breadcrumbs:\Role\Models\Role'])->group(function () {
    /**
     * Roles
     *
     */
    // Route::delete('roles/delete/many', 'RoleManyController@delete')->name('roles.many.delete');
    // Route::delete('roles/delete/{role}', 'RoleController@delete')->name('roles.delete');
    // Route::delete('roles/destroy/many', 'RoleManyController@destroy')->name('roles.many.destroy');
    // Route::get('roles/refresh', 'RoleRefreshController@index')->name('roles.refresh.index');
    // Route::get('roles/trashed', 'RoleController@trashed')->name('roles.trashed');
    // Route::post('roles/refresh', 'RoleRefreshController@refresh')->name('roles.refresh.refresh');
    // Route::post('roles/restore/many', 'RoleManyController@restore')->name('roles.many.restore');
    // Route::post('roles/{role}/restore', 'RoleController@restore')->name('roles.restore');
    Route::softDeletes('roles', 'RoleController');
    Route::resource('roles', 'RoleController');

    /**
     * Permissions
     *
     */
    Route::get('permissions/refresh', 'PermissionController@edit')->name('permissions.edit');
    Route::post('permissions/refresh', 'PermissionController@refresh')->name('permissions.refresh');
    Route::post('permissions/reset', 'PermissionController@reset')->name('permissions.reset');
    Route::get('permissions', 'PermissionController@index')->name('permissions.index');
});

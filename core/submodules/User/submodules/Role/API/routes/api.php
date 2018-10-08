<?php

Route::delete('roles/destroy/{role}', '\Role\API\Controllers\RoleController@destroy')->name('roles.destroy');
Route::delete('roles/delete/{role}', '\Role\API\Controllers\RoleController@delete')->name('roles.delete');
Route::get('roles/all', '\Role\API\Controllers\RoleController@all')->name('roles.all');
Route::get('roles/search', '\Role\API\Controllers\RoleController@search')->name('roles.search');
Route::get('roles/trashed/all', '\Role\API\Controllers\RoleController@getTrash')->name('roles.trashed.all');
Route::post('roles/grants', '\Role\API\Controllers\RoleController@grants')->name('roles.grants');
Route::post('roles/{role}/clone', '\Role\API\Controllers\RoleController@clone')->name('roles.clone');
Route::post('roles/{role}/restore', '\Role\API\Controllers\RoleController@restore')->name('roles.restore');

Route::delete('grants/delete/{grant}', '\Role\API\Controllers\GrantController@destroy')->name('grants.destroy');
Route::get('grants/all', '\Role\API\Controllers\GrantController@all')->name('grants.all');
Route::get('grants/search', '\Role\API\Controllers\GrantController@search')->name('grants.search');
Route::get('grants/trashed/all', '\Role\API\Controllers\GrantController@all')->name('grants.trashed.all');
Route::post('grants/permissions', '\Role\API\Controllers\GrantController@permissions')->name('grants.permissions');
Route::post('grants/{grant}/clone', '\Role\API\Controllers\GrantController@clone')->name('grants.clone');

Route::get('permissions/all', '\Role\API\Controllers\PermissionController@all')->name('permissions.all');
Route::get('permissions/search', '\Role\API\Controllers\PermissionController@search')->name('permissions.search');

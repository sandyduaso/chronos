<?php

Route::delete('catalogues/destroy/{catalogue}', '\Catalogue\API\Controllers\CatalogueController@destroy')->name('catalogues.destroy');
Route::delete('catalogues/delete/{catalogue}', '\Catalogue\API\Controllers\CatalogueController@delete')->name('catalogues.delete');
Route::get('catalogues/all', '\Catalogue\API\Controllers\CatalogueController@all')->name('catalogues.all');
Route::get('catalogues/search', '\Catalogue\API\Controllers\CatalogueController@search')->name('catalogues.search');
Route::get('catalogues/trash/all', '\Catalogue\API\Controllers\CatalogueController@getTrash')->name('catalogues.trash.all');
Route::post('catalogues/grants', '\Catalogue\API\Controllers\CatalogueController@grants')->name('catalogues.grants');
Route::post('catalogues/{catalogue}/clone', '\Catalogue\API\Controllers\CatalogueController@clone')->name('catalogues.clone');
Route::post('catalogues/{catalogue}/restore', '\Catalogue\API\Controllers\CatalogueController@restore')->name('catalogues.restore');

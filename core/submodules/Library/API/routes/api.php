<?php

Route::delete('library/destroy/{library}', '\Library\API\Controllers\LibraryController@destroy')->name('library.destroy');
Route::delete('library/delete/{library}', '\Library\API\Controllers\LibraryController@delete')->name('library.delete');
Route::get('library/all', '\Library\API\Controllers\LibraryController@all')->name('library.all');
Route::get('library/paginated', '\Library\API\Controllers\LibraryController@paginated')->name('library.paginated');
Route::get('library/search', '\Library\API\Controllers\LibraryController@search')->name('library.search');
Route::get('library/trash', '\Library\API\Controllers\LibraryController@getTrash')->name('library.trash');
Route::get('library/catalogues', '\Library\API\Controllers\LibraryController@catalogues')->name('library.catalogues');
Route::get('library/catalogue/{catalogue}', '\Library\API\Controllers\LibraryController@fromCatalogue')->name('library.catalogue');
Route::post('library/{library}/clone', '\Library\API\Controllers\LibraryController@clone')->name('library.clone');
Route::post('library/upload', '\Library\API\Controllers\LibraryController@upload')->name('library.upload');
Route::post('library/{library}/restore', '\Library\API\Controllers\LibraryController@restore')->name('library.restore');

Route::get('library/all', '\Library\API\Controllers\LibraryController@all')->name('library.all');
Route::get('library/search', '\Library\API\Controllers\LibraryController@search')->name('library.search');
Route::group(['prefix' => 'v1'], function () {
    //
});

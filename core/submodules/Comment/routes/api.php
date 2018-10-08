<?php

Route::post('comments/lists', '\Comment\Controllers\API\CommentController@index')
    ->name('comments.lists');

Route::post('comments/store', '\Comment\Controllers\API\CommentController@store')
    ->name('comments.store');

Route::post('comments/update', '\Comment\Controllers\API\CommentController@update')
    ->name('comments.update');

Route::get('comments/all', '\Comment\Controllers\API\CommentController@index')
    ->name('comments.all');

Route::delete('comments/destroy', '\Comment\Controllers\API\CommentController@destroy')
    ->name('comments.destroy');

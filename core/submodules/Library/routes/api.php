<?php

use Catalogue\Models\Catalogue;
use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    # Catalogues
    Route::post('library/catalogues', function (Request $request) {
        return response()->json(Catalogue::catalogued($request->input('params') ?? []));
    })->name('library.catalogues');

    # API normal routes
    Route::get('library/all', 'LibraryController@getAll')->name('library.all');
});

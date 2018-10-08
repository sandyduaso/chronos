<?php

Route::group(['prefix' => 'library'], function () {

    /**
     * -------------------------------------------------------------------------
     * Catalogue Routes
     * -------------------------------------------------------------------------
     *
     */
    // Route::delete('catalogues/delete/many', '\Catalogue\Controllers\CatalogueManyController@delete')->name('catalogues.many.delete');
    // Route::delete('catalogues/delete/{catalogue}', '\Catalogue\Controllers\CatalogueController@delete')->name('catalogues.delete');
    // Route::delete('catalogues/destroy/many', '\Catalogue\Controllers\CatalogueManyController@destroy')->name('catalogues.many.destroy');
    // Route::get('catalogues/refresh', '\Catalogue\Controllers\CatalogueRefreshController@index')->name('catalogues.refresh.index');
    // Route::get('catalogues/trash', '\Catalogue\Controllers\CatalogueController@trash')->name('catalogues.trash');
    // Route::post('catalogues/refresh', '\Catalogue\Controllers\CatalogueRefreshController@refresh')->name('catalogues.refresh.refresh');
    // Route::post('catalogues/restore/many', '\Catalogue\Controllers\CatalogueManyController@restore')->name('catalogues.many.restore');
    // Route::post('catalogues/{catalogue}/restore', '\Catalogue\Controllers\CatalogueController@restore')->name('catalogues.restore');
    Route::resource('catalogues', '\Catalogue\Controllers\CatalogueController');
});

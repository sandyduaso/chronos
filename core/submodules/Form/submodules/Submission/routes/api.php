<?php

/**
 * -----------------------------------------------------------------------------
 * API Submission Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('submissions/all', 'SubmissionController@getAll')->name('submissions.all');

    Route::get('submissions/find', 'SubmissionController@postFind')->name('submissions.find');
    Route::get('submissions/search', 'SubmissionController@postFind')->name('submissions.search');

    Route::get('submissions/{submission}', 'SubmissionController@getShow')->name('submissions.show');

    // Route::post('submissions/{submission}', 'SubmissionController@getRestore')->name('submissions.restore');
    // Statistics
    Route::post('submissions/results/analytic', 'AnalyticController@getStatistic')->name('submissions.analytic');
});

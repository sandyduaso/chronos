<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Submission Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

Route::group(['prefix' => 'forms'], function () {
    // SoftDelete routes
    Route::get('submissions/trashed', 'SubmissionController@trashed')
         ->name('submissions.trashed');

    Route::patch('submissions/restore/{fieldtype}', 'SubmissionController@restore')
         ->name('submissions.restore');

    Route::delete('submissions/delete/{fieldtype}', 'SubmissionController@delete')
         ->name('submissions.delete');

    Route::post('submissions/submit', 'SubmissionController@submit')
         ->name('submissions.submit');

    // Results
    Route::get('submissions/result/{submission}', 'SubmissionController@result')
         ->name('submissions.result');

    // Reports
    Route::post('submissions/{submission}/export', 'SubmissionController@export')
         ->name('submissions.export');

    // Admin routes
    Route::resource('submissions', 'SubmissionController')->except(['store']);
});

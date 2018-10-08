<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     * -------------------------------------------------------------------------
     * Submission Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-submission' => [
        'name' => 'submissions.index',
        'code' => 'view-submission',
        'description' => 'Ability to view list of submissions',
        'group' => 'submission',
    ],
    'show-submission' => [
        'name' => 'submissions.show',
        'code' => 'show-submission',
        'description' => 'Ability to show a single submission',
        'group' => 'submission',
    ],
    'create-submission' => [
        'name' => 'submissions.create',
        'code' => 'create-submission',
        'description' => 'Ability to show the form to create submission',
        'group' => 'submission',
    ],
    'store-submission' => [
        'name' => 'submissions.store',
        'code' => 'store-submission',
        'description' => 'Ability to save the submission',
        'group' => 'submission',
    ],
    'edit-submission' => [
        'name' => 'submissions.edit',
        'code' => 'edit-submission',
        'description' => 'Ability to show the form to edit submission',
        'group' => 'submission',
    ],
    'update-submission' => [
        'name' => 'submissions.update',
        'code' => 'update-submission',
        'description' => 'Ability to update the submission',
        'group' => 'submission',
    ],
    'destroy-submission' => [
        'name' =>  'submissions.destroy',
        'code' => 'destroy-submission',
        'description' => 'Ability to move the submission to trash',
        'group' => 'submission',
    ],
    'delete-submission' => [
        'name' =>  'submissions.delete',
        'code' => 'delete-submission',
        'description' => 'Ability to permanently delete the submission',
        'group' => 'submission',
    ],
    'trashed-submission' => [
        'name' => 'submissions.trashed',
        'code' => 'trashed-submission',
        'description' => 'Ability to view the list of all trashed submission',
        'group' => 'submission',
    ],
    'restore-submission' => [
        'name' => 'submissions.restore',
        'code' => 'restore-submission',
        'description' => 'Ability to restore the submission',
        'group' => 'submission',
    ],
    'submit-submission' => [
        'name' => 'submissions.submit',
        'code' => 'submit-submission',
        'description' => 'Ability to submit the submission',
        'group' => 'submission',
    ],
    'restore-submission' => [
        'name' => 'submissions.restore',
        'code' => 'restore-submission',
        'description' => 'Ability to restore the submission',
        'group' => 'submission',
    ],
];

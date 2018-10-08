<?php
/**
 * -----------------------------------------------------------------------------
 * Permissions Array
 * -----------------------------------------------------------------------------
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
     * Library Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-library' => [
        'name' =>  'library.index',
        'code' => 'view-library',
        'description' => 'Ability to view list of library',
        'group' => 'library',
    ],
    'show-library' => [
        'name' => 'library.show',
        'code' => 'show-library',
        'description' => 'Ability to show a single library',
        'group' => 'library',
    ],
    'create-library' => [
        'name' => 'library.create',
        'code' => 'create-library',
        'description' => 'Ability to show the form to create library',
        'group' => 'library',
    ],
    'store-library' => [
        'name' => 'library.store',
        'code' => 'store-library',
        'description' => 'Ability to save the library',
        'group' => 'library',
    ],
    'edit-library' => [
        'name' => 'library.edit',
        'code' => 'edit-library',
        'description' => 'Ability to show the form to edit library',
        'group' => 'library',
    ],
    'update-library' => [
        'name' => 'library.update',
        'code' => 'update-library',
        'description' => 'Ability to update the library',
        'group' => 'library',
    ],
    'destroy-library' => [
        'name' =>  'library.destroy',
        'code' => 'destroy-library',
        'description' => 'Ability to move the library to trash',
        'group' => 'library',
    ],
    'delete-library' => [
        'name' =>  'library.delete',
        'code' => 'delete-library',
        'description' => 'Ability to permanently delete the library',
        'group' => 'library',
    ],
    'trash-library' => [
        'name' =>  'library.trash',
        'code' => 'trash-library',
        'description' => 'Ability to view the list of all trashed library',
        'group' => 'library',
    ],
    'restore-library' => [
        'name' => 'library.restore',
        'code' => 'restore-library',
        'description' => 'Ability to restore the library',
        'group' => 'library',
    ],

    // Many
    'destroy-many-library' => [
        'name' =>  'library.many.destroy',
        'code' => 'destroy-many-library',
        'description' => 'Ability to destroy many library',
        'group' => 'library',
    ],
    'delete-many-library' => [
        'name' =>  'library.many.delete',
        'code' => 'delete-many-library',
        'description' => 'Ability to permanently delete many library',
        'group' => 'library',
    ],
    'restore-many-library' => [
        'name' => 'library.many.restore',
        'code' => 'restore-many-library',
        'description' => 'Ability to restore many library',
        'group' => 'library',
    ],

    //
];

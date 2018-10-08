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
     * Catalogue Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-catalogue' => [
        'name' =>  'catalogues.index',
        'code' => 'view-catalogue',
        'description' => 'Ability to view list of catalogues',
        'group' => 'catalogue',
    ],
    'show-catalogue' => [
        'name' => 'catalogues.show',
        'code' => 'show-catalogue',
        'description' => 'Ability to show a single catalogue',
        'group' => 'catalogue',
    ],
    'create-catalogue' => [
        'name' => 'catalogues.create',
        'code' => 'create-catalogue',
        'description' => 'Ability to show the form to create catalogue',
        'group' => 'catalogue',
    ],
    'store-catalogue' => [
        'name' => 'catalogues.store',
        'code' => 'store-catalogue',
        'description' => 'Ability to save the catalogue',
        'group' => 'catalogue',
    ],
    'edit-catalogue' => [
        'name' => 'catalogues.edit',
        'code' => 'edit-catalogue',
        'description' => 'Ability to show the form to edit catalogue',
        'group' => 'catalogue',
    ],
    'update-catalogue' => [
        'name' => 'catalogues.update',
        'code' => 'update-catalogue',
        'description' => 'Ability to update the catalogue',
        'group' => 'catalogue',
    ],
    'destroy-catalogue' => [
        'name' =>  'catalogues.destroy',
        'code' => 'destroy-catalogue',
        'description' => 'Ability to move the catalogue to trash',
        'group' => 'catalogue',
    ],
    'delete-catalogue' => [
        'name' =>  'catalogues.delete',
        'code' => 'delete-catalogue',
        'description' => 'Ability to permanently delete the catalogue',
        'group' => 'catalogue',
    ],
    'trash-catalogue' => [
        'name' =>  'catalogues.trash',
        'code' => 'trash-catalogue',
        'description' => 'Ability to view the list of all trashed catalogue',
        'group' => 'catalogue',
    ],
    'restore-catalogue' => [
        'name' => 'catalogues.restore',
        'code' => 'restore-catalogue',
        'description' => 'Ability to restore the catalogue',
        'group' => 'catalogue',
    ],

    // Many
    'destroy-many-catalogue' => [
        'name' =>  'catalogues.many.destroy',
        'code' => 'destroy-many-catalogue',
        'description' => 'Ability to destroy many catalogues',
        'group' => 'catalogue',
    ],
    'delete-many-catalogue' => [
        'name' =>  'catalogues.many.delete',
        'code' => 'delete-many-catalogue',
        'description' => 'Ability to permanently delete many catalogues',
        'group' => 'catalogue',
    ],
    'restore-many-catalogue' => [
        'name' => 'catalogues.many.restore',
        'code' => 'restore-many-catalogue',
        'description' => 'Ability to restore many catalogues',
        'group' => 'catalogue',
    ],

    //
];

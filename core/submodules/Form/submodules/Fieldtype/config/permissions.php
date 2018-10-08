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
     * Fieldtype Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-fieldtype' => [
        'name' =>  'fieldtypes.index',
        'code' => 'view-fieldtype',
        'description' => 'Ability to view list of fieldtypes',
        'group' => 'fieldtype',
    ],
    'show-fieldtype' => [
        'name' => 'fieldtypes.show',
        'code' => 'show-fieldtype',
        'description' => 'Ability to show a single fieldtype',
        'group' => 'fieldtype',
    ],
    'create-fieldtype' => [
        'name' => 'fieldtypes.create',
        'code' => 'create-fieldtype',
        'description' => 'Ability to show the form to create fieldtype',
        'group' => 'fieldtype',
    ],
    'store-fieldtype' => [
        'name' => 'fieldtypes.store',
        'code' => 'store-fieldtype',
        'description' => 'Ability to save the fieldtype',
        'group' => 'fieldtype',
    ],
    'edit-fieldtype' => [
        'name' => 'fieldtypes.edit',
        'code' => 'edit-fieldtype',
        'description' => 'Ability to show the form to edit fieldtype',
        'group' => 'fieldtype',
    ],
    'update-fieldtype' => [
        'name' => 'fieldtypes.update',
        'code' => 'update-fieldtype',
        'description' => 'Ability to update the fieldtype',
        'group' => 'fieldtype',
    ],
    'destroy-fieldtype' => [
        'name' =>  'fieldtypes.destroy',
        'code' => 'destroy-fieldtype',
        'description' => 'Ability to move the fieldtype to trash',
        'group' => 'fieldtype',
    ],
    'delete-fieldtype' => [
        'name' =>  'fieldtypes.delete',
        'code' => 'delete-fieldtype',
        'description' => 'Ability to permanently delete the fieldtype',
        'group' => 'fieldtype',
    ],
    'trash-fieldtype' => [
        'name' =>  'fieldtypes.trash',
        'code' => 'trash-fieldtype',
        'description' => 'Ability to view the list of all trashed fieldtype',
        'group' => 'fieldtype',
    ],
    'restore-fieldtype' => [
        'name' => 'fieldtypes.restore',
        'code' => 'restore-fieldtype',
        'description' => 'Ability to restore the fieldtype',
        'group' => 'fieldtype',
    ],

    // Many
    'destroy-many-fieldtype' => [
        'name' =>  'fieldtypes.many.destroy',
        'code' => 'destroy-many-fieldtype',
        'description' => 'Ability to destroy many fieldtypes',
        'group' => 'fieldtype',
    ],
    'delete-many-fieldtype' => [
        'name' =>  'fieldtypes.many.delete',
        'code' => 'delete-many-fieldtype',
        'description' => 'Ability to permanently delete many fieldtypes',
        'group' => 'fieldtype',
    ],
    'restore-many-fieldtype' => [
        'name' => 'fieldtypes.many.restore',
        'code' => 'restore-many-fieldtype',
        'description' => 'Ability to restore many fieldtypes',
        'group' => 'fieldtype',
    ],

    //
];

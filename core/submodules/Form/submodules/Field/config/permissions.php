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
     * Field Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-field' => [
        'name' =>  'fields.index',
        'code' => 'view-field',
        'description' => 'Ability to view list of fields',
        'group' => 'field',
    ],
    'show-field' => [
        'name' => 'fields.show',
        'code' => 'show-field',
        'description' => 'Ability to show a single field',
        'group' => 'field',
    ],
    'create-field' => [
        'name' => 'fields.create',
        'code' => 'create-field',
        'description' => 'Ability to show the form to create field',
        'group' => 'field',
    ],
    'store-field' => [
        'name' => 'fields.store',
        'code' => 'store-field',
        'description' => 'Ability to save the field',
        'group' => 'field',
    ],
    'edit-field' => [
        'name' => 'fields.edit',
        'code' => 'edit-field',
        'description' => 'Ability to show the form to edit field',
        'group' => 'field',
    ],
    'update-field' => [
        'name' => 'fields.update',
        'code' => 'update-field',
        'description' => 'Ability to update the field',
        'group' => 'field',
    ],
    'destroy-field' => [
        'name' =>  'fields.destroy',
        'code' => 'destroy-field',
        'description' => 'Ability to move the field to trash',
        'group' => 'field',
    ],
    'delete-field' => [
        'name' =>  'fields.delete',
        'code' => 'delete-field',
        'description' => 'Ability to permanently delete the field',
        'group' => 'field',
    ],
    'trash-field' => [
        'name' =>  'fields.trash',
        'code' => 'trash-field',
        'description' => 'Ability to view the list of all trashed field',
        'group' => 'field',
    ],
    'restore-field' => [
        'name' => 'fields.restore',
        'code' => 'restore-field',
        'description' => 'Ability to restore the field',
        'group' => 'field',
    ],

    // Many
    'destroy-many-field' => [
        'name' =>  'fields.many.destroy',
        'code' => 'destroy-many-field',
        'description' => 'Ability to destroy many fields',
        'group' => 'field',
    ],
    'delete-many-field' => [
        'name' =>  'fields.many.delete',
        'code' => 'delete-many-field',
        'description' => 'Ability to permanently delete many fields',
        'group' => 'field',
    ],
    'restore-many-field' => [
        'name' => 'fields.many.restore',
        'code' => 'restore-many-field',
        'description' => 'Ability to restore many fields',
        'group' => 'field',
    ],

    //
];

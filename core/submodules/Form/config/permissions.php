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
     * Form Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-form' => [
        'name' =>  'forms.index',
        'code' => 'view-form',
        'description' => 'Ability to view list of forms',
        'group' => 'form',
    ],
    'show-form' => [
        'name' => 'forms.show',
        'code' => 'show-form',
        'description' => 'Ability to show a single form',
        'group' => 'form',
    ],
    'create-form' => [
        'name' => 'forms.create',
        'code' => 'create-form',
        'description' => 'Ability to show the form to create form',
        'group' => 'form',
    ],
    'store-form' => [
        'name' => 'forms.store',
        'code' => 'store-form',
        'description' => 'Ability to save the form',
        'group' => 'form',
    ],
    'edit-form' => [
        'name' => 'forms.edit',
        'code' => 'edit-form',
        'description' => 'Ability to show the form to edit form',
        'group' => 'form',
    ],
    'update-form' => [
        'name' => 'forms.update',
        'code' => 'update-form',
        'description' => 'Ability to update the form',
        'group' => 'form',
    ],
    'destroy-form' => [
        'name' =>  'forms.destroy',
        'code' => 'destroy-form',
        'description' => 'Ability to move the form to trash',
        'group' => 'form',
    ],
    'delete-form' => [
        'name' =>  'forms.delete',
        'code' => 'delete-form',
        'description' => 'Ability to permanently delete the form',
        'group' => 'form',
    ],
    'trash-form' => [
        'name' =>  'forms.trash',
        'code' => 'trash-form',
        'description' => 'Ability to view the list of all trashed form',
        'group' => 'form',
    ],
    'restore-form' => [
        'name' => 'forms.restore',
        'code' => 'restore-form',
        'description' => 'Ability to restore the form',
        'group' => 'form',
    ],

    // Many
    'destroy-many-form' => [
        'name' =>  'forms.many.destroy',
        'code' => 'destroy-many-form',
        'description' => 'Ability to destroy many forms',
        'group' => 'form',
    ],
    'delete-many-form' => [
        'name' =>  'forms.many.delete',
        'code' => 'delete-many-form',
        'description' => 'Ability to permanently delete many forms',
        'group' => 'form',
    ],
    'restore-many-form' => [
        'name' => 'forms.many.restore',
        'code' => 'restore-many-form',
        'description' => 'Ability to restore many forms',
        'group' => 'form',
    ],

    //
];

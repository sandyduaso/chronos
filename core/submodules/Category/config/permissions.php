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
     * Category Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-category' => [
        'name' =>  'categories.index',
        'code' => 'view-category',
        'description' => 'Ability to view list of categories',
        'group' => 'category',
    ],
    'show-category' => [
        'name' => 'categories.show',
        'code' => 'show-category',
        'description' => 'Ability to show a single category',
        'group' => 'category',
    ],
    'create-category' => [
        'name' => 'categories.create',
        'code' => 'create-category',
        'description' => 'Ability to show the form to create category',
        'group' => 'category',
    ],
    'store-category' => [
        'name' => 'categories.store',
        'code' => 'store-category',
        'description' => 'Ability to save the category',
        'group' => 'category',
    ],
    'edit-category' => [
        'name' => 'categories.edit',
        'code' => 'edit-category',
        'description' => 'Ability to show the form to edit category',
        'group' => 'category',
    ],
    'update-category' => [
        'name' => 'categories.update',
        'code' => 'update-category',
        'description' => 'Ability to update the category',
        'group' => 'category',
    ],
    'destroy-category' => [
        'name' =>  'categories.destroy',
        'code' => 'destroy-category',
        'description' => 'Ability to move the category to trash',
        'group' => 'category',
    ],
    'delete-category' => [
        'name' =>  'categories.delete',
        'code' => 'delete-category',
        'description' => 'Ability to permanently delete the category',
        'group' => 'category',
    ],
    'trash-category' => [
        'name' =>  'categories.trash',
        'code' => 'trash-category',
        'description' => 'Ability to view the list of all trashed category',
        'group' => 'category',
    ],
    'restore-category' => [
        'name' => 'categories.restore',
        'code' => 'restore-category',
        'description' => 'Ability to restore the category',
        'group' => 'category',
    ],

    // Many
    'destroy-many-category' => [
        'name' =>  'categories.many.destroy',
        'code' => 'destroy-many-category',
        'description' => 'Ability to destroy many categories',
        'group' => 'category',
    ],
    'delete-many-category' => [
        'name' =>  'categories.many.delete',
        'code' => 'delete-many-category',
        'description' => 'Ability to permanently delete many categories',
        'group' => 'category',
    ],
    'restore-many-category' => [
        'name' => 'categories.many.restore',
        'code' => 'restore-many-category',
        'description' => 'Ability to restore many categories',
        'group' => 'category',
    ],

    //
];

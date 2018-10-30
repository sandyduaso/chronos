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
     * Theme Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-theme' => [
        'name' =>  'themes.index',
        'code' => 'view-theme',
        'description' => 'Ability to view list of themes',
        'group' => 'theme',
    ],
    'show-theme' => [
        'name' => 'themes.show',
        'code' => 'show-theme',
        'description' => 'Ability to show a single theme',
        'group' => 'theme',
    ],
    'create-theme' => [
        'name' => 'themes.create',
        'code' => 'create-theme',
        'description' => 'Ability to show the form to create theme',
        'group' => 'theme',
    ],
    'store-theme' => [
        'name' => 'themes.store',
        'code' => 'store-theme',
        'description' => 'Ability to save the theme',
        'group' => 'theme',
    ],
    'edit-theme' => [
        'name' => 'themes.edit',
        'code' => 'edit-theme',
        'description' => 'Ability to show the form to edit theme',
        'group' => 'theme',
    ],
    'update-theme' => [
        'name' => 'themes.update',
        'code' => 'update-theme',
        'description' => 'Ability to update the theme',
        'group' => 'theme',
    ],
    'destroy-theme' => [
        'name' =>  'themes.destroy',
        'code' => 'destroy-theme',
        'description' => 'Ability to move the theme to trash',
        'group' => 'theme',
    ],
    'delete-theme' => [
        'name' =>  'themes.delete',
        'code' => 'delete-theme',
        'description' => 'Ability to permanently delete the theme',
        'group' => 'theme',
    ],
    'trash-theme' => [
        'name' =>  'themes.trash',
        'code' => 'trash-theme',
        'description' => 'Ability to view the list of all trashed theme',
        'group' => 'theme',
    ],
    'restore-theme' => [
        'name' => 'themes.restore',
        'code' => 'restore-theme',
        'description' => 'Ability to restore the theme',
        'group' => 'theme',
    ],

    // Many
    'destroy-many-theme' => [
        'name' =>  'themes.many.destroy',
        'code' => 'destroy-many-theme',
        'description' => 'Ability to destroy many themes',
        'group' => 'theme',
    ],
    'delete-many-theme' => [
        'name' =>  'themes.many.delete',
        'code' => 'delete-many-theme',
        'description' => 'Ability to permanently delete many themes',
        'group' => 'theme',
    ],
    'restore-many-theme' => [
        'name' => 'themes.many.restore',
        'code' => 'restore-many-theme',
        'description' => 'Ability to restore many themes',
        'group' => 'theme',
    ],

    //
];

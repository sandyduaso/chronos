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
     * Menu Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-menu' => [
        'name' =>  'menus.index',
        'code' => 'view-menu',
        'description' => 'Ability to view list of menus',
        'group' => 'menu, appearance',
    ],
    'show-menu' => [
        'name' => 'menus.show',
        'code' => 'show-menu',
        'description' => 'Ability to show a single menu',
        'group' => 'menu, appearance',
    ],
    'create-menu' => [
        'name' => 'menus.create',
        'code' => 'create-menu',
        'description' => 'Ability to show the form to create menu',
        'group' => 'menu, appearance',
    ],
    'store-menu' => [
        'name' => 'menus.store',
        'code' => 'store-menu',
        'description' => 'Ability to save the menu',
        'group' => 'menu, appearance',
    ],
    'edit-menu' => [
        'name' => 'menus.edit',
        'code' => 'edit-menu',
        'description' => 'Ability to show the form to edit menu',
        'group' => 'menu, appearance',
    ],
    'update-menu' => [
        'name' => 'menus.update',
        'code' => 'update-menu',
        'description' => 'Ability to update the menu',
        'group' => 'menu, appearance',
    ],
    'destroy-menu' => [
        'name' =>  'menus.destroy',
        'code' => 'destroy-menu',
        'description' => 'Ability to move the menu to trash',
        'group' => 'menu, appearance',
    ],
    'delete-menu' => [
        'name' =>  'menus.delete',
        'code' => 'delete-menu',
        'description' => 'Ability to permanently delete the menu',
        'group' => 'menu, appearance',
    ],
    'trash-menu' => [
        'name' =>  'menus.trash',
        'code' => 'trash-menu',
        'description' => 'Ability to view the list of all trashed menu',
        'group' => 'menu, appearance',
    ],
    'restore-menu' => [
        'name' => 'menus.restore',
        'code' => 'restore-menu',
        'description' => 'Ability to restore the menu',
        'group' => 'menu, appearance',
    ],

    // Many
    'destroy-many-menu' => [
        'name' =>  'menus.many.destroy',
        'code' => 'destroy-many-menu',
        'description' => 'Ability to destroy many menus',
        'group' => 'menu, appearance',
    ],
    'delete-many-menu' => [
        'name' =>  'menus.many.delete',
        'code' => 'delete-many-menu',
        'description' => 'Ability to permanently delete many menus',
        'group' => 'menu, appearance',
    ],
    'restore-many-menu' => [
        'name' => 'menus.many.restore',
        'code' => 'restore-many-menu',
        'description' => 'Ability to restore many menus',
        'group' => 'menu, appearance',
    ],

    //
];

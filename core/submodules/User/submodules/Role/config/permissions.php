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
     *--------------------------------------------------------------------------
     * Role Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-roles' => [
        'name' =>  'view-roles',
        'code' => 'roles.index',
        'description' => 'Ability to view list of roles',
        'group' => 'roles',
    ],
    'show-role' => [
        'name' => 'show-role',
        'code' => 'roles.show',
        'description' => 'Ability to show a single role',
        'group' => 'roles',
    ],
    'create-role' => [
        'name' => 'create-role',
        'code' => 'roles.create',
        'description' => 'Ability to create new role',
        'group' => 'roles',
    ],
    'store-role' => [
        'name' => 'store-role',
        'code' => 'roles.store',
        'description' => 'Ability to save the role',
        'group' => 'roles',
    ],
    'update-role' => [
        'name' => 'update-role',
        'code' => 'roles.update',
        'description' => 'Ability to update the role',
        'group' => 'roles',
    ],
    'destroy-role' => [
        'name' => 'destroy-role',
        'code' =>  'roles.destroy',
        'description' => 'Ability to move the role to trash',
        'group' => 'roles',
    ],
    'delete-role' => [
        'name' => 'delete-role',
        'code' =>  'roles.delete',
        'description' => 'Ability to permanently delete the role',
        'group' => 'roles',
    ],
    'trashed-roles' => [
        'name' => 'trashed-roles',
        'code' =>  'roles.trashed',
        'description' => 'Ability to view the list of all trashed roles',
        'group' => 'roles',
    ],
    'restore-role' => [
        'name' => 'restore-role',
        'code' => 'roles.restore',
        'description' => 'Ability to restore the role from trash',
        'group' => 'roles',
    ],

    /**
     * -------------------------------------------------------------------------
     * Permissions Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-permissions' => [
        'name' =>  'view-permissions',
        'code' => 'permissions.index',
        'description' => 'Ability to view list of permissions',
        'group' => 'permissions',
    ],
    'show-permission' => [
        'name' => 'show-permission',
        'code' => 'permissions.show',
        'description' => 'Ability to show a single permission',
        'group' => 'permissions',
    ],
    'reset-permission' => [
        'name' => 'reset-permission',
        'code' => 'permissions.reset',
        'description' => 'Ability to reset the permission',
        'group' => 'permissions',
    ],
    'refresh-permission' => [
        'name' => 'refresh-permission',
        'code' => 'permissions.refresh',
        'description' => 'Ability to refresh the permission',
        'group' => 'permissions',
    ],
];

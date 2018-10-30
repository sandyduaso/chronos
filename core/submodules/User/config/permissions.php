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
     * User Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-users' => [
        'name' =>  'view-users',
        'code' => 'users.index',
        'description' => 'Ability to view list of users',
        'group' => 'users',
    ],
    'show-user' => [
        'name' => 'show-user',
        'code' => 'users.show',
        'description' => 'Ability to show a single user',
        'group' => 'users',
    ],
    'create-user' => [
        'name' => 'create-user',
        'code' => 'users.create',
        'description' => 'Ability to create new user',
        'group' => 'users',
    ],
    'store-user' => [
        'name' => 'store-user',
        'code' => 'users.store',
        'description' => 'Ability to save the user',
        'group' => 'users',
    ],
    'edit-user' => [
        'name' => 'edit-user',
        'code' => 'users.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'users',
    ],
    'update-user' => [
        'name' => 'update-user',
        'code' => 'users.update',
        'description' => 'Ability to update the user',
        'group' => 'users',
    ],
    'destroy-user' => [
        'name' => 'destroy-user',
        'code' =>  'users.destroy',
        'description' => 'Ability to move the user to trash',
        'group' => 'users',
    ],
    'delete-user' => [
        'name' => 'delete-user',
        'code' =>  'users.delete',
        'description' => 'Ability to permanently delete the user',
        'group' => 'users',
    ],
    'trashed-users' => [
        'name' => 'trashed-users',
        'code' =>  'users.trashed',
        'description' => 'Ability to view the list of all trashed users',
        'group' => 'users',
    ],
    'restore-user' => [
        'name' => 'restore-user',
        'code' => 'users.restore',
        'description' => 'Ability to restore the user from trash',
        'group' => 'users',
    ],

    // Password
    'change-password' => [
        'name' =>  'change-password',
        'code' => 'password.change',
        'description' => 'Ability to change the user password without using the old password',
        'group' => 'users',
    ],

    /**
     *--------------------------------------------------------------------------
     * Limited Access Policies
     *--------------------------------------------------------------------------
     * The policy stated below will limit the users to only interact with
     * resources they created. Using this policy, the resource will usually have
     * a `user_id` field defined. A Policy Class is also required to check
     * authorization.
     *
     * E.g.
     *  1. User1 will only be able to edit/delete their own created pages.
     *  2. User1 will not be able to edit User2's created pages.
     *  3. User1 will not be able to delete User2's created pages.
     *  4. User1 will be able to view other users created pages. Although this can
     *     be set to be otherwise. It will depend on the Policy file.
     */
    'unrestricted-user-access' => [
        'name' => 'unrestricted-user-access',
        'code' => 'users.unrestricted',
        'description' => 'Ability to edit and delete all users even if the user is not the creator of the user.',
        'group' => 'users',
    ],
];

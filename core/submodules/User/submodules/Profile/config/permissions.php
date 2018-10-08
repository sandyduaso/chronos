<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
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
     * Profile Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-profile' => [
        'name' =>  'profile.index',
        'code' => 'view-profile',
        'description' => 'Ability to view list of profiles',
        'group' => 'profile',
    ],
    'show-profile' => [
        'name' => 'profile.show',
        'code' => 'show-profile',
        'description' => 'Ability to show a single profile',
        'group' => 'profile',
    ],
    'store-profile' => [
        'name' => 'profile.store',
        'code' => 'store-profile',
        'description' => 'Ability to save the profile',
        'group' => 'profile',
    ],
    'edit-profile' => [
        'name' => 'profile.edit',
        'code' => 'edit-profile',
        'description' => 'Ability to show the form to edit profile',
        'group' => 'profile',
    ],
    'update-profile' => [
        'name' => 'profile.update',
        'code' => 'update-profile',
        'description' => 'Ability to update the profile',
        'group' => 'profile',
    ],

    /**
     *--------------------------------------------------------------------------
     * Credentials Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-credential' => [
        'name' => 'credentials.index',
        'code' => 'view-credential',
        'description' => 'Ability to view list of credentials',
        'group' => 'profile',
    ],
    'show-credential' => [
        'name' => 'credentials.show',
        'code' => 'show-credential',
        'description' => 'Ability to show a single credential',
        'group' => 'profile',
    ],
    'store-credential' => [
        'name' => 'credentials.store',
        'code' => 'store-credential',
        'description' => 'Ability to save the credential',
        'group' => 'profile',
    ],
    'edit-credential' => [
        'name' => 'credentials.edit',
        'code' => 'edit-credential',
        'description' => 'Ability to show the form to edit credential',
        'group' => 'profile',
    ],
    'update-credential' => [
        'name' => 'credentials.update',
        'code' => 'update-credential',
        'description' => 'Ability to update the credential',
        'group' => 'profile',
    ],
];

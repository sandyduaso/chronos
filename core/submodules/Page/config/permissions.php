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
     * Page Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-pages' => [
        'name' =>  'view-pages',
        'code' => 'pages.index',
        'description' => 'Ability to view list of pages',
        'group' => 'pages',
    ],
    'show-page' => [
        'name' => 'show-page',
        'code' => 'pages.show',
        'description' => 'Ability to show a single page',
        'group' => 'pages',
    ],
    'create-page' => [
        'name' => 'create-page',
        'code' => 'pages.create',
        'description' => 'Ability to create new page',
        'group' => 'pages',
    ],
    'store-page' => [
        'name' => 'store-page',
        'code' => 'pages.store',
        'description' => 'Ability to save the page',
        'group' => 'pages',
    ],
    'edit-page' => [
        'name' => 'edit-page',
        'code' => 'pages.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'pages',
    ],
    'update-page' => [
        'name' => 'update-page',
        'code' => 'pages.update',
        'description' => 'Ability to update the page',
        'group' => 'pages',
    ],
    'destroy-page' => [
        'name' => 'destroy-page',
        'code' =>  'pages.destroy',
        'description' => 'Ability to move the page to trash',
        'group' => 'pages',
    ],
    'delete-page' => [
        'name' => 'delete-page',
        'code' =>  'pages.delete',
        'description' => 'Ability to permanently delete the page',
        'group' => 'pages',
    ],
    'trashed-pages' => [
        'name' => 'trashed-pages',
        'code' =>  'pages.trashed',
        'description' => 'Ability to view the list of all trashed pages',
        'group' => 'pages',
    ],
    'restore-page' => [
        'name' => 'restore-page',
        'code' => 'pages.restore',
        'description' => 'Ability to restore the page from trash',
        'group' => 'pages',
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
    'unrestricted-page-access' => [
        'name' => 'unrestricted-page-access',
        'code' => 'pages.unrestricted',
        'description' => 'Ability to edit and delete all pages even if the user is not the creator of the page.',
        'group' => 'pages',
    ],
];

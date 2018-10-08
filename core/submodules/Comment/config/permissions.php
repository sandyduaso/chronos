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
    'view-comment' => [
        'name' =>  'comments.index',
        'code' => 'view-comment',
        'description' => 'Ability to view list of comments',
        'group' => 'comment',
    ],
    'show-comment' => [
        'name' => 'comments.show',
        'code' => 'show-comment',
        'description' => 'Ability to show a single comment',
        'group' => 'comment',
    ],
    'store-comment' => [
        'name' => 'comments.store',
        'code' => 'store-comment',
        'description' => 'Ability to save the comment',
        'group' => 'comment',
    ],
    'post-comment' => [
        'name' => 'comments.post',
        'code' => 'post-comment',
        'description' => 'Ability to save the comment',
        'group' => 'comment',
    ],
    'edit-comment' => [
        'name' => 'comments.edit',
        'code' => 'edit-comment',
        'description' => 'Ability to show the form to edit comment',
        'group' => 'comment',
    ],
    'update-comment' => [
        'name' => 'comments.update',
        'code' => 'update-comment',
        'description' => 'Ability to update the comment',
        'group' => 'comment',
    ],
    'destroy-comment' => [
        'name' =>  'comments.destroy',
        'code' => 'destroy-comment',
        'description' => 'Ability to move the comment to trash',
        'group' => 'comment',
    ],
    'trashed-comment' => [
        'name' =>  'comments.trashed',
        'code' => 'trashed-comment',
        'description' => 'Ability to view the list of all trashed comment',
        'group' => 'comment',
    ],
    'delete-comment' => [
        'name' =>  'comments.delete',
        'code' => 'delete-comment',
        'description' => 'Ability to permanently delete the comment',
        'group' => 'comment',
    ],
    'restore-comment' => [
        'name' => 'comments.restore',
        'code' => 'restore-comment',
        'description' => 'Ability to restore the comment',
        'group' => 'comment',
    ],
];

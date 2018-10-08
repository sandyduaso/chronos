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
     * -------------------------------------------------------------------------
     * Activity Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-activity' => [
        'name' => 'activities.index',
        'code' => 'view-activity',
        'description' => 'Ability to view list of activities',
        'group' => 'activity',
    ],
    'show-activity' => [
        'name' => 'activities.show',
        'code' => 'show-activity',
        'description' => 'Ability to show a single activity',
        'group' => 'activity',
    ],
    'create-activity' => [
        'name' => 'activities.create',
        'code' => 'create-activity',
        'description' => 'Ability to show the form to create activity',
        'group' => 'activity',
    ],
    'store-activity' => [
        'name' => 'activities.store',
        'code' => 'store-activity',
        'description' => 'Ability to save the activity',
        'group' => 'activity',
    ],
    'edit-activity' => [
        'name' => 'activities.edit',
        'code' => 'edit-activity',
        'description' => 'Ability to show the form to edit activity',
        'group' => 'activity',
    ],
    'update-activity' => [
        'name' => 'activities.update',
        'code' => 'update-activity',
        'description' => 'Ability to update the activity',
        'group' => 'activity',
    ],
    'destroy-activity' => [
        'name' =>  'activities.destroy',
        'code' => 'destroy-activity',
        'description' => 'Ability to move the activity to trash',
        'group' => 'activity',
    ],
    'delete-activity' => [
        'name' =>  'activities.delete',
        'code' => 'delete-activity',
        'description' => 'Ability to permanently delete the activity',
        'group' => 'activity',
    ],
    'trashed-activity' => [
        'name' => 'activities.trashed',
        'code' => 'trashed-activity',
        'description' => 'Ability to view the list of all trashed activity',
        'group' => 'activity',
    ],
    'restore-activity' => [
        'name' => 'activities.restore',
        'code' => 'restore-activity',
        'description' => 'Ability to restore the activity',
        'group' => 'activity',
    ],
];

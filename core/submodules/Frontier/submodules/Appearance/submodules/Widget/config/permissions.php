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
     * Widget Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-widget' => [
        'name' =>  'widgets.index',
        'code' => 'view-widget',
        'description' => 'Ability to view list of widgets',
        'group' => 'widget, appearance',
    ],
    'show-widget' => [
        'name' => 'widgets.show',
        'code' => 'show-widget',
        'description' => 'Ability to show a single widget',
        'group' => 'widget, appearance',
    ],
    'create-widget' => [
        'name' => 'widgets.create',
        'code' => 'create-widget',
        'description' => 'Ability to show the form to create widget',
        'group' => 'widget, appearance',
    ],
    'store-widget' => [
        'name' => 'widgets.store',
        'code' => 'store-widget',
        'description' => 'Ability to save the widget',
        'group' => 'widget, appearance',
    ],
    'edit-widget' => [
        'name' => 'widgets.edit',
        'code' => 'edit-widget',
        'description' => 'Ability to show the form to edit widget',
        'group' => 'widget, appearance',
    ],
    'update-widget' => [
        'name' => 'widgets.update',
        'code' => 'update-widget',
        'description' => 'Ability to update the widget',
        'group' => 'widget, appearance',
    ],
    'destroy-widget' => [
        'name' =>  'widgets.destroy',
        'code' => 'destroy-widget',
        'description' => 'Ability to move the widget to trash',
        'group' => 'widget, appearance',
    ],
    'delete-widget' => [
        'name' =>  'widgets.delete',
        'code' => 'delete-widget',
        'description' => 'Ability to permanently delete the widget',
        'group' => 'widget, appearance',
    ],
    'trashed-widget' => [
        'name' =>  'widgets.trashed',
        'code' => 'trashed-widget',
        'description' => 'Ability to view the list of all trashed widget',
        'group' => 'widget, appearance',
    ],
    'restore-widget' => [
        'name' => 'widgets.restore',
        'code' => 'restore-widget',
        'description' => 'Ability to restore the widget',
        'group' => 'widget, appearance',
    ],
];

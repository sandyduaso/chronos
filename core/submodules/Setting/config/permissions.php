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
    'view-setting' => [
        'name' =>  'settings.index',
        'code' => 'view-setting',
        'description' => 'Ability to view list of settings',
        'group' => 'setting',
    ],
    'show-setting' => [
        'name' => 'settings.show',
        'code' => 'show-setting',
        'description' => 'Ability to show a single setting',
        'group' => 'setting',
    ],
    'create-setting' => [
        'name' => 'settings.create',
        'code' => 'create-setting',
        'description' => 'Ability to show the form to create setting',
        'group' => 'setting',
    ],
    'store-setting' => [
        'name' => 'settings.store',
        'code' => 'store-setting',
        'description' => 'Ability to save the setting',
        'group' => 'setting',
    ],
    'edit-setting' => [
        'name' => 'settings.edit',
        'code' => 'edit-setting',
        'description' => 'Ability to show the form to edit setting',
        'group' => 'setting',
    ],
    'update-setting' => [
        'name' => 'settings.update',
        'code' => 'update-setting',
        'description' => 'Ability to update the setting',
        'group' => 'setting',
    ],
    'destroy-setting' => [
        'name' =>  'settings.destroy',
        'code' => 'destroy-setting',
        'description' => 'Ability to move the setting to trash',
        'group' => 'setting',
    ],
    'delete-setting' => [
        'name' =>  'settings.delete',
        'code' => 'delete-setting',
        'description' => 'Ability to permanently delete the setting',
        'group' => 'setting',
    ],
    'trash-setting' => [
        'name' =>  'settings.trash',
        'code' => 'trash-setting',
        'description' => 'Ability to view the list of all trashed setting',
        'group' => 'setting',
    ],
    'restore-setting' => [
        'name' => 'settings.restore',
        'code' => 'restore-setting',
        'description' => 'Ability to restore the setting',
        'group' => 'setting',
    ],

    /**
     *--------------------------------------------------------------------------
     * Settings
     *--------------------------------------------------------------------------
     *
     */
    'general-settings' => [
        'name' =>  'settings.general',
        'code' => 'general-settings',
        'description' => 'Ability to view list of general settings',
        'group' => 'setting, appearance',
    ],

    'display-settings' => [
        'name' =>  'settings.display',
        'code' => 'display-settings',
        'description' => 'Ability to view list of display settings',
        'group' => 'setting, appearance',
    ],

    'branding-settings' => [
        'name' =>  'settings.branding',
        'code' => 'branding-settings',
        'description' => 'Ability to view list of branding settings',
        'group' => 'setting, appearance',
    ],

    'social-media-settings' => [
        'name' =>  'settings.social',
        'code' => 'social-media-settings',
        'description' => 'Ability to view list of social media settings',
        'group' => 'setting, appearance',
    ],

    'themes-settings' => [
        'name' =>  'settings.themes',
        'code' => 'themes-settings',
        'description' => 'Ability to view list of themes settings',
        'group' => 'setting, appearance',
    ],
];

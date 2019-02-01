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
    'store-setting' => [
        'name' => 'settings.store',
        'code' => 'store-setting',
        'description' => 'Ability to save the setting',
        'group' => 'settings',
    ],

    /**
     *--------------------------------------------------------------------------
     * Settings
     *--------------------------------------------------------------------------
     *
     */
    'general-settings' => [
        'name' =>  'general-settings',
        'code' => 'settings:general.index',
        'description' => 'Ability to view list of general settings',
        'group' => 'settings',
    ],

    'display-settings' => [
        'name' =>  'display-settings',
        'code' => 'settings:display.index',
        'description' => 'Ability to view list of display settings',
        'group' => 'settings',
    ],

    'branding-settings' => [
        'name' =>  'branding-settings',
        'code' => 'settings:branding.index',
        'description' => 'Ability to view list of branding settings',
        'group' => 'settings',
    ],

    'social-media-settings' => [
        'name' =>  'settings.social',
        'code' => 'settings:social.index',
        'description' => 'Ability to view list of social media settings',
        'group' => 'settings',
    ],

    'themes-settings' => [
        'name' =>  'settings.themes',
        'code' => 'settings:themes.index',
        'description' => 'Ability to view list of themes settings',
        'group' => 'settings',
    ],
];

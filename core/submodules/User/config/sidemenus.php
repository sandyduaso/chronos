<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Users
     *--------------------------------------------------------------------------
     *
     * Sidemenu configurations.
     *
     */
    'user-account' => [
        'name' => 'user-account',
        'order' => 1,
        'slug' => route('users.index'),
        'always_viewable' => false,
        'icon' => 'fe fe-users',
        'labels' => [
            'title' => __('Account Info'),
            'description' => __("Manage users, roles, and permissions"),
        ],
    ],
];

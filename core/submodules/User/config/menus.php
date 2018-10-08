<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Users
     *--------------------------------------------------------------------------
     *
     * Menu configurations.
     *
     */
    'user' => [
        'name' => 'user',
        'order' => 600,
        'slug' => route('users.index'),
        'always_viewable' => false,
        'icon' => 'fe fe-users',
        'labels' => [
            'title' => __('Users'),
            'description' => __("Manage users, roles, and permissions"),
        ],
        'children' => [
            'view-user' => [
                'name' => 'view-user',
                'order' => 1,
                'slug' => route('users.index'),
                'code' => 'users.index',
                'routes' => [
                    'name' => 'users.index',
                    'children' => [
                        'users.edit',
                        'users.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Users'),
                    'description' => 'View list of all users'
                ],
            ],

            'create-user' => [
                'name' => 'create-user',
                'order' => 2,
                'slug' => route('users.create'),
                'code' => 'users.create',
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.create',
                ],
                'labels' => [
                    'title' => __('Create User'),
                    'description' => __('Create new user account'),
                ],
            ],
            'trashed-user' => [
                'name' => 'trashed-user',
                'order' => 3,
                'slug' => route('users.trashed'),
                'code' => 'users.trashed',
                'icon' => 'fe fe-user-x',
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.trashed',
                ],
                'labels' => [
                    'title' => __('Deactivated Users'),
                    'description' => __('View list of deactivated users'),
                ],
            ],
        ],
    ],
];

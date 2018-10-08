<?php

return [
    'divider-role' => [
        'name' => 'divider-role',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'user',
        'order' => 9,
    ],

    'view-roles' => [
        'name' => 'view-roles',
        'slug' => route('roles.index'),
        'code' => 'roles.index',
        'routes' => [
            'name' => 'roles.index',
            'children' => [
                'roles.create',
                'roles.edit',
                'roles.show',
                'roles.trashed',
            ]
        ],
        'parent' => 'user',
        'order' => 10,
        'always_viewable' => false,
        'icon' => 'fe fe-user-check',
        'labels' => [
            'title' => __('Roles'),
            'description' => __('View the list of all roles'),
        ],
    ],

    'view-permissions' => [
        'name' => 'view-permissions',
        'slug' => route('permissions.index'),
        'code' => 'permissions.index',
        'parent' => 'user',
        'order' => 30,
        'routes' => [
            'name' => 'permissions.index',
            'children' => [
                'permissions.create',
                'permissions.edit',
                'permissions.show',
                'permissions.trashed',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'fe fe-check-circle',
        'labels' => [
            'title' => __('Permissions'),
            'description' => __('View the list of all permissions'),
        ],
    ],
];

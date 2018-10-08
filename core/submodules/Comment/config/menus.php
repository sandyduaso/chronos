<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Comments Settings Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */

    'commenting-settings-group' => [
        'name' => 'commenting-settings-group',
        'slug' => route('settings.commenting'),
        'order' => 10,
        'parent' => 'settings',
        'is_group_link' => true,
        'always_viewable' => false,
        // 'display_as_header' => true,
        'icon' => 'comments',
        'labels' => [
            'title' => __('Commenting'),
            'description' => __('Manage the way users comments on you pages.'),
        ],
        'routes' => [
            'name' => 'settings.commenting',
            'children' => [
                'settings.commenting',
            ]
        ],
        'children' => [
            'commenting-settings' => [
                'name' => 'commenting-settings',
                'slug' => route('settings.commenting'),
                'route' => 'settings.commenting',
                'icon' => 'comment',
                'order' => 2,
                'labels' => [
                    'title' => __('Commenting'),
                    'description' => __('Manage the way users comments on you pages.'),
                ],
            ],
        ],
    ],
];

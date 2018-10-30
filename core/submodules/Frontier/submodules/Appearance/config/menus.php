<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Appearance Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'appearance' => [
        'name' => 'appearance',
        'order' => 500,
        'slug' => '#',
        'always_viewable' => false,
        'is_hidden' => false,
        'icon' => 'mdi mdi-palette',
        'labels' => [
            'title' => __('Appearance'),
            'description' => __('Manage themes, menus, custom menus and more.'),
        ],
    ],
];

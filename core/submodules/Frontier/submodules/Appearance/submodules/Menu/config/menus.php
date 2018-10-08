<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Menus Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'view-menu' => [
        'name' => 'view-menu',
        'order' => 10,
        'slug' => route('menus.index'),
        'routes' => [
            'name' => 'menus.index',
            'children' => [
                'menus.create',
                'menus.edit',
                'menus.show',
                'menus.trash',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'menu',
        'parent' => 'appearance',
        'labels' => [
            'title' => __('Menus'),
            'description' => __('Manage public menus'),
        ],
    ],
];

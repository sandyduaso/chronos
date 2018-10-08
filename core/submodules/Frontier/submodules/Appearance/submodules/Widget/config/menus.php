<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Widgets Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menu to appear on the sidebar.
     *
     */
    'view-widget' => [
        'name' => 'view-widget',
        'order' => 10,
        'slug' => route('widgets.index'),
        'routes' => [
            'name' => 'widgets.index',
            'children' => [
                'widgets.create',
                'widgets.edit',
                'widgets.show',
                'widgets.trash',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'widgets',
        'parent' => 'appearance',
        'labels' => [
            'title' => __('Widgets'),
            'description' => __('Manage app widgets'),
        ],
    ],
];

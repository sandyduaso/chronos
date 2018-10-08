<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Themes Menus
     * -------------------------------------------------------------------------
     * Specify here the themes to appear on the sidebar.
     *
     */
    'view-theme' => [
        'name' => 'view-theme',
        'order' => 10,
        'slug' => route('themes.index'),
        'routes' => [
            'name' => 'themes.index',
            'children' => [
                'themes.create',
                'themes.edit',
                'themes.show',
                'themes.trash',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'format_paint',
        'parent' => 'appearance',
        'labels' => [
            'title' => __('Themes'),
            'description' => __('Manage public themes'),
        ],
    ],
];

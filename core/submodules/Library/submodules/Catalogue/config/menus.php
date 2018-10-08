<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Catalogues Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'divider-catalogue' => [
        'name' => 'divider-catalogue',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'library',
        'order' => 9,
    ],

    'view-catalogue' => [
        'name' => 'view-catalogue',
        'order' => 10,
        'slug' => url(config('path.admin').'/library/catalogues'),
        'always_viewable' => false,
        'icon' => 'book',
        'parent' => 'library',
        'routes' => [
            'name' => 'catalogues.index',
            'children' => [
                'catalogues.create',
                'catalogues.edit',
                'catalogues.show',
                'catalogues.trash',
            ]
        ],
        'labels' => [
            'title' => __('Catalogues'),
            'description' => __('Manage all library catalogues'),
        ],
    ],
];

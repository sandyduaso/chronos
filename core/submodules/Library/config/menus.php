<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Library Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'library' => [
        'name' => 'library',
        'order' => 51,
        'slug' => url(config('path.admin').'/library'),
        'is_parent' => true,
        'always_viewable' => false,
        'icon' => 'mdi mdi-library-books',
        'labels' => [
            'title' => __('Library'),
            'description' => __('Manage collections in library'),
        ],
        'children' => [
            'view-library' => [
                'name' => 'view-library',
                'order' => 1,
                'slug' => route('library.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Library'),
                    'description' => __('View the list of all collections in library'),
                ],
            ],
            'trashed-library' => [
                'name' => 'trashed-library',
                'order' => 3,
                'slug' => route('library.trash'),
                'always_viewable' => false,
                'icon' => 'archive',
                'labels' => [
                    'title' => __('Archived'),
                    'description' => __('View list of all collections in library moved to trash'),
                ],
            ],
        ],
    ],
];

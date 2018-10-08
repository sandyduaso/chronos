<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Submissions Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'view-submission' => [
        'name' => 'view-submission',
        'order' => 10,
        'slug' => url(config('path.admin').'/forms/submissions'),
        'always_viewable' => false,
        'icon' => 'playlist_add_check',
        'parent' => 'form',
        'routes' => [
            'name' => 'submissions.index',
            'children' => [
                'submissions.create',
                'submissions.edit',
                'submissions.show',
                'submissions.trash',
            ]
        ],
        'labels' => [
            'title' => __('List of Submissions'),
            'description' => __('Manage all form submissions'),
        ],
    ],
];

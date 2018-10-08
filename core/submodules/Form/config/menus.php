<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Forms Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'form' => [
        'name' => 'form',
        'order' => 110,
        'slug' => route('forms.index'),
        'always_viewable' => false,
        'icon' => 'format_line_spacing',
        'labels' => [
            'title' => __('Forms'),
            'description' => __('Manage forms'),
        ],
        'children' => [
            'view-form' => [
                'name' => 'view-form',
                'order' => 1,
                'slug' => route('forms.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Forms'),
                    'description' => __('View the list of all forms'),
                ],
            ],
            'create-form' => [
                'name' => 'create-form',
                'order' => 2,
                'slug' => route('forms.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Form'),
                    'description' => __('Create a Form'),
                ],
            ],
            'trashed-form' => [
                'name' => 'trashed-form',
                'order' => 3,
                'slug' => route('forms.trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Forms'),
                    'description' => __('View list of all forms moved to trashed'),
                ],
            ],
        ],
    ],
];

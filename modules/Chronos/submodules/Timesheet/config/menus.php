<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Timesheets Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'timesheet' => [
        'name' => 'timesheet',
        'order' => 51,
        'slug' => route('timesheets.index'),
        'always_viewable' => false,
        'icon' => 'mdi mdi-calendar-clock',
        'labels' => [
            'title' => __('Timesheets'),
            'description' => __('Manage timesheets'),
        ],
        'children' => [
            'view-timesheets' => [
                'name' => 'view-timesheets',
                'order' => 1,
                'slug' => route('timesheets.index'),
                'code' => 'timesheets.index',
                'always_viewable' => false,
                'routes' => [
                    'name' => 'timesheets.index',
                    'children' => [
                        'timesheets.edit',
                        'timesheets.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Timesheets'),
                    'description' => __('View the list of all timesheets'),
                ],
            ],
            'create-timesheet' => [
                'name' => 'create-timesheet',
                'order' => 2,
                'slug' => route('timesheets.create'),
                'code' => 'timesheets.create',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('New Timesheet'),
                    'description' => __('Upload a Timesheet'),
                ],
            ],
            'trashed-timesheet' => [
                'name' => 'trashed-timesheet',
                'order' => 3,
                'slug' => route('timesheets.trashed'),
                'code' => 'timesheets.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Archived'),
                    'description' => __('View list of all timesheets moved to trash'),
                ],
            ],

            'divider-timesheet-trashed-settings' => [
                'name' => 'divider-timesheet-trashed-settings',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'timesheet',
                'order' => 4,
            ],

            'settings-timesheet' => [
                'name' => 'settings-timesheet',
                'order' => 5,
                'slug' => route('timesheets.settings'),
                'code' => 'timesheets.settings',
                'icon' => 'fe fe-sliders',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Settings'),
                    'description' => __('View settings for timesheets'),
                ],
            ],
        ],
    ],
];

<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Employees Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'employee' => [
        'name' => 'employee',
        'order' => 53,
        'slug' => route('employees.index'),
        'always_viewable' => false,
        'icon' => 'mdi mdi-clipboard-account',
        'icon' => 'mdi mdi-clipboard-account',
        'labels' => [
            'title' => __('Office'),
            'description' => __('Manage employees'),
        ],
        'children' => [
            'view-employees' => [
                'name' => 'view-employees',
                'order' => 1,
                'slug' => route('employees.index'),
                'code' => 'employees.index',
                'icon' => 'mdi mdi-worker',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Employees'),
                    'description' => __('View the list of all employees'),
                ],
            ],

            'view-departments' => [
                'name' => 'view-departments',
                'slug' => route('departments.index'),
                'code' => 'departments.index',
                'routes' => [
                    'name' => 'departments.index',
                    'children' => [
                        'departments.create',
                        'departments.edit',
                        'departments.show',
                        'departments.trashed',
                    ]
                ],
                'parent' => 'employee',
                'order' => 10,
                'always_viewable' => false,
                'icon' => 'mdi mdi-door-closed',
                'labels' => [
                    'title' => __('Departments'),
                    'description' => __('View the list of all departments'),
                ],
            ],
        ],
    ],
];

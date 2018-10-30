<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 30,
        'slug' => '#',
        'always_viewable' => false,
        'icon' => 'mdi mdi-file',
        'labels' => [
            'title' => __('Pages'),
            'description' => __('Manage site pages'),
        ],
        'children' => [
            'public-pages' => [
                'name' => 'public-pages',
                'code' => 'pages.public',
                'slug' => route('pages.index'),
                'exclude_from_root' => true,
                'order' => 1,
                'labels' => [
                    'title' => __('Public Pages'),
                    'description' => __('Manage site pages'),
                ],
            ],
            'view-pages' => [
                'name' => 'view-pages',
                'code' => 'pages.index',
                'slug' => route('pages.index'),
                'order' => 1,
                'routes' => [
                    'name' => 'pages.index',
                    'children' => [
                        'pages.edit',
                        'pages.show',
                    ],
                ],
                'labels' => [
                    'title' => __('All Pages'),
                    'description' => __('Manage site pages'),
                ],
            ],
            'create-page' => [
                'name' => 'create-page',
                'code' => 'pages.create',
                'order' => 2,
                'slug' => route('pages.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Page'),
                    'description' => __('Create new page'),
                ],
            ],
            'trashed-pages' => [
                'name' => 'trashed-pages',
                'code' => 'pages.trashed',
                'order' => 3,
                'slug' => route('pages.trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Pages'),
                    'description' => __('View list of all trashed pages'),
                ],
            ],
        ],
    ],
];

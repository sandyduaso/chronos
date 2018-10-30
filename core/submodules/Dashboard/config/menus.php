<?php

return [
    'dashboard' => [
        'name' => 'dashboard',
        'is_parent' => true,
        'order' => 5,
        'slug' => route('dashboard'),
        'always_viewable' => true,
        'icon' => 'mdi mdi-view-dashboard',
        'labels' => [
            'title' => __('Dashboard'),
            'description' => __('View summary and overview of the app.'),
        ],
    ],

    'content' => [
        'name' => 'content',
        'is_header' => true,
        'order' => 20, // 20 or 4
        'class' => 'separator',
        'markup' => 'span',
        'text' => __('Content'),
    ],

    // 'tools' => [
    //     'name' => 'tools',
    //     'is_header' => true,
    //     'order' => 100,
    //     'class' => 'separator',
    //     'markup' => 'span',
    //     'text' => __('Tools'),
    // ],
];

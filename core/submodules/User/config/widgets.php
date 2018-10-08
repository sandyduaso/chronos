<?php

return [

    'enabled' => [

        'user-count' => [
            'name' => __('Users'),
            'description' => __("Count of users per role."),
            'location' => 'dashboard.2',
            'code' => 'user-count',
            'icon' => 'fe fe-user-plus',
            'view' => 'User::widgets.users'
        ],

        'user-activity' => [
            'name' => __('User Activities'),
            'description' => __("View the user's activities."),
            'location' => 'dashboard.2.2',
            'code' => 'user-activity',
            'icon' => 'multiline_chart',
            'view' => 'User::widgets.activity',
        ],

    ],
];

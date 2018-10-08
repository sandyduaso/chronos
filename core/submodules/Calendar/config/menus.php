<?php

return [
    'calendar' => [
        'name' => 'calendar',
        'is_parent' => true,
        'order' => 700,
        'slug' => url(config('path.admin').'/calendars'),
        'always_viewable' => false,
        'icon' => 'date_range',
        'labels' => [
            'title' => __('Calendar'),
            'description' => __('Manage holidays, birthdays, events, and more'),
        ],
    ],
];

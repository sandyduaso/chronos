<?php

return [
    'enabled' => [
        'new-timesheet' => [
            'name' => __('Timesheet'),
            'description' => __('Timesheet details'),
            'location' => 'dashboard.2',
            'code' => 'new-timesheet',
            'icon' => 'mdi mdi-calendar-clock',
            'sort' => 100,
            'view' => 'Timesheet::widgets.newtimesheet'
        ],
    ],
];

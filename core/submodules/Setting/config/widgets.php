<?php

return [
    'enabled' => [

        'cpu-usage' => [
            'name' => __("CPU Usage"),
            'description' => __("The CPU Usage in percentage."),
            'location' => 'dashboard.2.1',
            'code' => 'cpu-usage',
            'icon' => 'fa-tachometer',
            'view' => 'Setting::widgets.cpu-usage',
        ],

        'system-corner' => [
            'name' => __("System Corner"),
            'description' => __("A general overview of the system."),
            'location' => 'dashboard.2.2',
            'code' => 'system-corner',
            'icon' => 'fa-tachometer',
            'view' => 'Setting::widgets.system-corner',
            'backdrop' => assets('frontier/images/placeholder/sql.jpg'),
        ],

    ],
];

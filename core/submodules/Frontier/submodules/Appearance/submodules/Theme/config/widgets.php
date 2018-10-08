<?php

return [
    'enabled' => [

        'themes' => [
            'name' => __("Theme"),
            'description' => __("Displays the current theme of the application."),
            'location' => 'dashboard.2.1',
            'code' => 'themes',
            'icon' => 'format_paint',
            'view' => 'Theme::widgets.themes',
        ],

    ],
];

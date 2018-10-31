<?php

return [
    [
        'appears' => [
            'Dashboard::admin.index',
            'Theme::admin.dashboard',
            'Theme::dashboard.dashboard',
            'Theme::dashboard.index',
        ],
        'class' => \Widget\Composers\WidgetViewComposer::class,
    ],
];

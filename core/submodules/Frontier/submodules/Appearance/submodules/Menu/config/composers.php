<?php

return [
    ['appears' => [
        'Template::*',
        'Template::templates.*',
        'Theme::templates.*',
        'Theme::layouts.public',
        'Template::layouts.public',
    ],
    'class' => \Menu\Composers\MainMenuViewComposer::class],
];

<?php

use Frontier\Composers\NavigationViewComposer;
use Frontier\Composers\SidebarComposer;
use Frontier\Support\Breadcrumbs\Composers\BreadcrumbComposer;

return [
    [
        'appears' => [
            'Theme::layouts.admin',
            'Theme::partials.breadrumbs',
        ],
        'class' => BreadcrumbComposer::class
    ],
    [
        'appears' => [
            'Theme::layouts.admin',
            'Theme::settings.*',
            'Theme::partials.sidemenu',
            'Theme::partials.settingsbar',
            'Setting::partials.settingsbar',
            'Setting::settings.*',
        ],
        'class' => NavigationViewComposer::class
    ],
    [
        'appears' => [
            'Theme::partials.sidebar',
        ],
        'class' => SidebarComposer::class
    ],
    [
        'appears' => [
            '*',
        ],
        'class' => \Frontier\Composers\ApplicationViewComposer::class
    ],
    [
        'appears' => [
            '*',
            'Theme::partials.header',
        ],
        'class' => \Frontier\Composers\ClientSideVariableViewComposer::class
    ],
    [
        'appears' => [
            'Theme::partials.sidemenu',
        ],
        'class' => \Frontier\Composers\SidemenuComposer::class
    ],

];

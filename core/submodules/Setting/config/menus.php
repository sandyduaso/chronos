<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Setting
     *--------------------------------------------------------------------------
     *
     */
    'settings' => [
        'name' => 'settings',
        'is_group_link' => true,
        'order' => 1000,
        'slug' => route('settings'),
        'always_viewable' => false,
        'icon' => 'mdi mdi-tune',
        'routes' => [
            'name' => 'settings',
            'children' => [
                'settings:display.index',
                'settings:datetime.index',
                'settings:branding.index',
                'settings:email.index',
                'settings.social',
                'group:settings.general',
            ]
        ],
        'labels' => [
            'title' => __('Settings'),
            'description' => __('Manage app settings'),
        ],
        'children' => [
            /**
             *------------------------------------------------------------------
             * General Settings
             *------------------------------------------------------------------
             *
             */
            'group:settings.general' => [
                'name' => 'group:settings.general',
                'slug' => route('settings:general.index'),
                'code' => 'group:settings.general',
                'is_group_link' => true,
                'always_viewable' => false,
                'order' => 1,
                'labels' => [
                    'title' => __('General'),
                    'description' => __('Manage time date formats, site modes, and other general site settings.'),
                ],
                'routes' => [
                    'name' => 'settings',
                    'children' => [
                        'settings:display.index',
                        'settings:datetime.index',
                    ]
                ],
                'children' => [
                    'settings:display.index' => [
                        'name' => 'settings:display.index',
                        'slug' => route('settings:display.index'),
                        'code' => 'settings:display.index',
                        'route' => 'settings:display.index',
                        'icon' => 'mdi mdi-table-settings',
                        'order' => 2,
                        'labels' => [
                            'title' => __('Displaying Data'),
                            'description' => __('Change the way data is displayed.'),
                        ],
                    ],

                    'settings:datetime.index' => [
                        'name' => 'settings:datetime.index',
                        'slug' => route('settings:datetime.index'),
                        'code' => 'settings:datetime.index',
                        'route' => 'settings:datetime.index',
                        'icon' => 'mdi mdi-calendar-clock',
                        'order' => 3,
                        'labels' => [
                            'title' => __('Date &amp; Time'),
                            'description' => __('Format date and time.'),
                        ],
                    ],
                ],
            ],

            /**
             *------------------------------------------------------------------
             * Branding Settings
             *------------------------------------------------------------------
             *
             */
            'group:settings.branding' => [
                'name' => 'group:settings.branding',
                'slug' => route('group:settings.branding'),
                'code' => 'group:settings.branding',
                'icon' => 'mdi mdi-leaf',
                'is_group_link' => true,
                'always_viewable' => false,
                'order' => 2,
                'labels' => [
                    'title' => __('Branding'),
                    'description' => __('Manage the branding options for the site.'),
                ],
                'routes' => [
                    'name' => 'settings:branding.index',
                    'children' => [
                        'settings:branding.index',
                        'settings:email.index',
                        'settings.social',
                    ]
                ],
                'children' => [
                    'settings:branding.index' => [
                        'name' => 'settings:branding.index',
                        'slug' => route('settings:branding.index'),
                        'code' => 'settings:branding.index',
                        'route' => 'settings:branding.index',
                        'icon' => 'fa-leaf',
                        'labels' => [
                            'title' => __('Site Branding'),
                            'description' => __('Manage the branding options for the site.'),
                        ],
                    ],

                    'settings:email.index' => [
                        'name' => 'settings:email.index',
                        'slug' => route('settings:email.index'),
                        'code' => 'settings:email.index',
                        'route' => 'settings:email.index',
                        'icon' => 'fa-envelope',
                        'labels' => [
                            'title' => __('Email Options'),
                            'description' => __('Manage mail settings'),
                        ],
                    ],

                    'social-media-settings' => [
                        'name' => 'social-media-settings',
                        'slug' => route('settings.social'),
                        'code' => 'settings.social',
                        'route' => 'settings.social',
                        'icon' => 'fa-twitter',
                        'labels' => [
                            'title' => __('Social Media'),
                            'description' => __("Manage the site's social media links"),
                        ],
                    ],
                ],
            ],

            /**
             *------------------------------------------------------------------
             * System Settings
             *------------------------------------------------------------------
             *
             */
            'settings-system-divider' => [
                'name' => 'settings-system-divider',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'settings',
                'order' => 999,
            ],

            'system-settings-group' => [
                'name' => 'system-settings-group',
                'slug' => route('settings.system'),
                'icon' => 'mdi mdi-settings-box',
                'always_viewable' => false,
                'order' => 1000,
                'labels' => [
                    'title' => __('System'),
                    'description' => __('Review the system settings'),
                ],
                'children' => [
                    'system-settings' => [
                        'name' => 'system-settings',
                        'slug' => route('settings.system'),
                        'code' => 'settings.system',
                        'route' => 'settings.system',
                        'icon' => 'mdi mdi-settings-box',
                        'always_viewable' => false,
                        'order' => 100,
                        'labels' => [
                            'title' => __('System Information'),
                            'description' => __('Review the system settings'),
                        ],
                    ],

                    'system-configuration-settings' => [
                        'name' => 'system-configuration-settings',
                        'slug' => route('settings.system.configuration'),
                        'code' => 'settings.system.configuration',
                        'route' => 'settings.system.configuration',
                        'icon' => 'mdi mdi-settings-box',
                        'always_viewable' => false,
                        'order' => 101,
                        'labels' => [
                            'title' => __('Configuration'),
                            'description' => __('Some more developer options'),
                        ],
                    ],
                ],
            ],
        ],
    ],
];

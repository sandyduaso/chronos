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
        'is_parent' => true,
        // 'is_group_link' => true,
        'order' => 1000,
        'slug' => route('settings'),
        'always_viewable' => false,
        'icon' => 'fe fe-sliders',
        'routes' => [
            'name' => 'settings',
            'children' => [
                'settings.general',
                'settings.display',
                'settings.branding',
                'settings.email',
                'settings.social',
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
            'general-settings-group' => [
                'name' => 'general-settings-group',
                'slug' => route('settings.display'),
                'code' => 'settings.display',
                'is_group_link' => true,
                'always_viewable' => false,
                'order' => 1,
                'labels' => [
                    'title' => __('General'),
                    'description' => __('Manage time date formats, site modes, and other general site settings.'),
                ],
                'routes' => [
                    'name' => 'settings.general',
                    'children' => [
                        'settings.general',
                        'settings.display',
                        'settings.datetime',
                    ]
                ],
                'children' => [
                    'display-settings' => [
                        'name' => 'display-settings',
                        'slug' => route('settings.display'),
                        'code' => 'settings.display',
                        'route' => 'settings.display',
                        'icon' => 'fa-table',
                        'order' => 2,
                        'labels' => [
                            'title' => __('Displaying Data'),
                            'description' => __('Change the way data is displayed.'),
                        ],
                    ],

                    'date-time-settings' => [
                        'name' => 'date-time-settings',
                        'slug' => route('settings.datetime'),
                        'code' => 'settings.datetime',
                        'route' => 'settings.datetime',
                        'icon' => 'access_time',
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
            'branding-settings-group' => [
                'name' => 'branding-settings-group',
                'slug' => route('settings.branding'),
                'code' => 'settings.branding',
                'is_group_link' => true,
                'always_viewable' => false,
                'order' => 2,
                'labels' => [
                    'title' => __('Branding'),
                    'description' => __('Manage the branding options for the site.'),
                ],
                'routes' => [
                    'name' => 'settings.branding',
                    'children' => [
                        'settings.branding',
                        'settings.email',
                        'settings.social',
                    ]
                ],
                'children' => [
                    'branding-settings' => [
                        'name' => 'branding-settings',
                        'slug' => route('settings.branding'),
                        'code' => 'settings.branding',
                        'route' => 'settings.branding',
                        'icon' => 'fa-leaf',
                        'labels' => [
                            'title' => __('Site Branding'),
                            'description' => __('Manage the branding options for the site.'),
                        ],
                    ],

                    'email-settings' => [
                        'name' => 'email-settings',
                        'slug' => route('settings.email'),
                        'code' => 'settings.email',
                        'route' => 'settings.email',
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
                'icon' => 'settings_applications',
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
                        'icon' => 'settings_applications',
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
                        'icon' => 'build',
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

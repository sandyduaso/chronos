<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Avatar Menus
     *--------------------------------------------------------------------------
     *
     */
    'avatar' => [

        // Hide from sidebar, we can still access this menu
        // via function: navigation('profile')
        'hidden' => true,
        'can_be_accessed' => false,
        'exclude_from_root' => true,

        'is_avatar' => true,
        'is_header' => false,
        'is_parent' => true,
        'order' => 0,
        'name' => 'avatar',
        'always_viewable' => false,
        'labels' => [
            'avatar' => user()->photo ?? '',
            'name' => user()->fullname ?? '',
            'role' => user()->displayrole ?? '',
            'email' => user()->displayemail ?? '',
        ],
        'children' => [
            /**
             *------------------------------------------------------------------
             * Profiles Menus
             *------------------------------------------------------------------
             *
             * Specify here the menus to appear on the sidebar.
             *
             */
            'profile-settings-group' => [
                'name' => 'profile-settings-group',
                'order' => 2,
                'slug' => route('profile.show', user()->handlename ?? ''),
                'always_viewable' => true,
                'is_group_link' => true,
                'icon' => 'account_circle',
                'labels' => [
                    'title' => __('My Profile'),
                    'description' => __('Manage profile'),
                ],
                'children' => [
                    'show-profile' => [
                        'name' => 'show-profile',
                        'order' => 1,
                        'slug' => route('profile.show', user()->handlename ?? ''),
                        'route' => 'profile.show',
                        'always_viewable' => true,
                        'icon' => 'account_circle',
                        'routes' => [
                            'name' => 'profile.show',
                            'children' => [
                                'profile.edit',
                                'profile.show',
                                'notes.show',
                            ]
                        ],
                        'labels' => [
                            'title' => __('My Profile'),
                            'description' => __('Manage profile'),
                        ],
                    ],
                    'edit-email' => [
                        'name' => 'edit-email',
                        'order' => 1,
                        'slug' => route('profile.emails.edit', user()->handlename ?? ''),
                        'route' => 'profile.emails.edit',
                        'always_viewable' => true,
                        'icon' => 'mail',
                        'labels' => [
                            'title' => __('Emails'),
                            'description' => __('Manage your email preferences'),
                        ],
                    ],
                ],
            ],

            'edit-credentials' => [
                'name' => 'edit-credentials',
                'order' => 500,
                'slug' => route('credentials.edit', user()->handlename ?? ''),
                'route' => 'credentials.edit',
                'always_viewable' => true,
                'icon' => 'vpn_key',
                'labels' => [
                    'title' => __('Credentials'),
                    'description' => __('Manage your account'),
                ],
            ],

            'profile-logout-divider' => [
                'name' => 'profile-logout-divider',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'profile',
                'order' => 999,
            ],

            /**
             *------------------------------------------------------------------
             * Logout
             *------------------------------------------------------------------
             *
             * Logout
             *
             */
            'logout' => [
                'name' => 'logout',
                'order' => 1000,
                'slug' => route('logout.logout'),
                'always_viewable' => true,
                'icon' => 'exit_to_app',
                'routes' => [
                    'name' => 'logout.logout',
                ],
                'labels' => [
                    'title' => __('Logout'),
                    'description' => __('Signout from the application'),
                ],
            ],
        ],
    ],
];

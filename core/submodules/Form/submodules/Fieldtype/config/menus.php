<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Fieldtypes Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'divider-field' => [
        'name' => 'divider-field',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'form',
        'order' => 9,
    ],

    'view-fieldtype' => [
        'name' => 'view-fieldtype',
        'slug' => url(config('path.admin').'/forms/fieldtypes'),
        'routes' => [
            'name' => 'fieldtypes.index',
            'children' => [
                'fieldtypes.create',
                'fieldtypes.edit',
                'fieldtypes.show',
                'fieldtypes.trash',
            ]
        ],
        'parent' => 'form',
        'order' => 10,
        'always_viewable' => false,
        'icon' => 'text_format',
        'labels' => [
            'title' => __('Fieldtypes'),
            'description' => __('View the list of all fieldtypes'),
        ],
    ],
];

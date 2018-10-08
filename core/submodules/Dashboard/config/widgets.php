<?php

return [
	'enabled' => [

		'glance' => [
			'name' => __('At A Glance'),
          	'description' => __("Some analytics to analyze."),
          	'location' => 'dashboard.1.12',
          	'code' => 'glance',
          	'icon' => 'fa-tachometer',
          	'view' => 'Dashboard::widgets.glance',
          	'backdrop' => assets('frontier/images/placeholder/sql.jpg'),
		],

	],
];

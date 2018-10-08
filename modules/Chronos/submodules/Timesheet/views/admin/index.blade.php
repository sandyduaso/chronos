@include('Theme::admin.index', [
  'resources' => $resources,
  'actions' => true,
  'buttons' => [
    'primary' => [
      'icon' => 'fe fe-plus',
      'text' => __('New Timesheet'),
      'url' => route('timesheets.create'),
    ],
  ],
  'label' => [
    'singular' => __('Timesheet'),
    'plural' => __('Timesheets'),
  ],
  'text' => [
    'singular' => 'timesheet',
    'plural' => 'timesheets',
  ],
  'table' => [
    'body' => [
      'name', 'uploader',
    ],
    'head' => [
      [
        'label' => __('Name'),
        'column' => 'name',
        'class' => 'pl-5',
        'colspan' => 1,
        'sortable' => true,
      ],
      [
        'label' => __('Uploader'),
        'column' => 'user_id',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
    ],
  ],
])

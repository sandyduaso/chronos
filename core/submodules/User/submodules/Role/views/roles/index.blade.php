@section('head:title', __('New Role'))
@section('page:title', __('New Role'))

@include('Theme::admin.index', [
  'resources' => $resources,
  'actions' => false,
  'buttons' => [
    'primary' => [
      'icon' => 'fe fe-plus',
      'text' => __('New Role'),
      'url' => route('roles.create'),
    ],
  ],
  'label' => [
    'singular' => __('Role'),
    'plural' => __('Roles'),
  ],
  'text' => [
    'singular' => 'role',
    'plural' => 'roles',
  ],
  'table' => [
    'body' => [
      'name', 'code', 'description', 'created',
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
        'label' => __('Code'),
        'column' => 'code',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
      [
        'label' => __('Description'),
        'column' => 'description',
        'class' => '',
        'colspan' => 1,
        'sortable' => false,
      ],
      [
        'label' => __('Date Added'),
        'column' => 'created_at',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
    ]
  ],
])

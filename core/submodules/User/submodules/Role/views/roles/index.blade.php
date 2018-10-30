@section('head:title', __('All Roles'))
@section('page:title', __('All Roles'))

@include('Theme::admin.index', [
  'resources' => $resources,
  'actions' => ['search', 'edit', 'show', 'destroy', 'trashed'],
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
      'name', 'code', 'description', 'permission_count', 'created',
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
        'label' => __('Permissions'),
        'column' => 'permission_count',
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

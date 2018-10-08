@push('after-footer')
  {{-- Export --}}
  @include('Theme::partials.modal', [
    'id' => 'export-confirmbox',
    'icon' => 'fe fe-download-cloud display-1 icon-border icon-faded d-inline-block',
    'lead' => __('Select format to download.'),
    'text' => __('Export data to a specific file type.'),
    'method' => 'POST',
    'button' => __('Download'),
    'action' => route('users.export'),
    'context' => 'primary',
    'include' => 'User::cards.field-export',
  ])

  {{-- Move to Trash --}}
  @include('Theme::partials.modal', [
    'id' => 'delete-confirmbox',
    'icon' => 'fe fe-user-x display-1 icon-border icon-faded d-inline-block',
    'lead' => __('You are about to deactivate the selected users.'),
    'text' => 'If you have selected your account and continued, you will be signed out from the app. Are you sure yout want to continue?',
    'method' => 'DELETE',
    'action' => route('users.destroy'),
    'button' => __('Deactivate Users'),
    'context' => 'warning',
  ])
@endpush

@include('Theme::admin.index', [
  'resources' => $resources,
  'label' => [
    'singular' => __('User'),
    'plural' => __('Users'),
  ],
  'text' => [
    'singular' => 'user',
    'plural' => 'users',
  ],
  'table' => [
    'body' => [
      'prefixname', 'displayname', 'email', 'displayrole', 'created',
    ],
    'head' => [
      [
        'label' => __('Account Name'),
        'column' => 'firstname',
        'class' => 'pl-5',
        'colspan' => 2,
        'sortable' => true,
      ],
      [
        'label' => __('Email'),
        'column' => 'email',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
      [
        'label' => __('Role'),
        'column' => 'role',
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
  ]
])

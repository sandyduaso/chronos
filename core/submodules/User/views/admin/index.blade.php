@extends("Theme::layouts.admin")

@section('page:header')
  @parent
  <a role="button" href="{{ route('users.create') }}" class="btn btn-primary btn-lg ml-auto"><i class="fe fe-user-plus"></i>&nbsp;{{ __('New User') }}</a>
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        @if ($resources->items())
          <div class="card">
            <div class="card-header border-0">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-sm-12 col-lg-4">
                    @include('Theme::partials.search')
                  </div>
                  <div class="col-sm-12 col-lg my-2">
                    {{-- Bulk Commands --}}
                    <div class="btn-toolbar justify-content-lg-end justify-content-between" role="toolbar" aria-label="{{ __('Bulk Commands') }}">
                      <div class="btn-group btn-group-toggle" role="group" data-toggle="buttons">
                        <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target=".table-select"><i class="fe fe-check-square"></i></button>
                      </div>
                      <div class="btn-group ml-3" role="group">
                        <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#export-confirmbox" title="{{ __('Select users to export') }}">
                          <i class="fe fe-download-cloud"></i>
                        </button>
                        <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#delete-confirmbox" title="{{ __('Select users to deactivate') }}">
                          <i class="fe fe-user-x"></i>
                        </button>
                      </div>

                      <div class="btn-group ml-3" role="group">
                        @include('Theme::partials.perpage')
                      </div>

                      <div class="btn-group ml-3" role="group">
                        <a role="button" href="{{ route('users.trashed') }}" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="{{ __('View deactivated users') }}">
                          <i class="fa fa-archive"></i>
                          <i class="fe fe-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                    {{-- Bulk Commands --}}
                  </div>
                </div>
              </div>
            </div>

            @if ($resources->lastPage() > 1)
              <header class="card-header justify-content-center border-0">
                @include('Theme::partials.pagination')
              </header>
            @endif

            <div class="table-responsive">
              <table data-with-selection class="table table-borderless card-table table-sm--disabled table-striped table-vcenter">
                <thead>
                  <tr>
                    <th class="table-select collapse">
                      <div class="custom-control custom-checkbox">
                        <input data-select-all="false" id="checkbox-all" type="checkbox" class="custom-control-input">
                        <label for="checkbox-all" class="custom-control-label"></label>
                      </div>
                    </th>
                    <th colspan="3" class="pl-5">
                      @if (request()->get('sort') === 'firstname')
                        @switch (request()->get('order'))
                          @case('asc')
                            <a href="{{ route('users.index', url_filter(['sort' => 'firstname', 'order' => 'desc'])) }}">{{ __('Account Name') }} <i class="fa fa-sort-alpha-down"></i></a>
                            @break

                          @case('desc')
                            <a href="{{ route('users.index', url_filter(['sort' => '', 'order' => ''])) }}">{{ __('Account Name') }} <i class="fa fa-sort-alpha-up"></i></a>
                            @break

                          @default
                            <a href="{{ route('users.index', url_filter(['sort' => 'firstname', 'order' => 'asc'])) }}">{{ __('Account Name') }}</a>
                        @endswitch
                      @else
                        <a href="{{ route('users.index', url_filter(['sort' => 'firstname', 'order' => 'asc'])) }}">{{ __('Account Name') }}</a>
                      @endif
                    </th>
                    <th>
                      @if (request()->get('sort') === 'email')
                        @switch (request()->get('order'))
                          @case('asc')
                            <a href="{{ route('users.index', url_filter(['sort' => 'email', 'order' => 'desc'])) }}">{{ __('Email') }} <i class="fa fa-sort-alpha-down"></i></a>
                            @break

                          @case('desc')
                            <a href="{{ route('users.index', url_filter(['sort' => '', 'order' => ''])) }}">{{ __('Email') }} <i class="fa fa-sort-alpha-up"></i></a>
                            @break

                          @default
                            <a href="{{ route('users.index', url_filter(['sort' => 'email', 'order' => 'asc'])) }}">{{ __('Email') }}</a>
                        @endswitch
                      @else
                        <a href="{{ route('users.index', url_filter(['sort' => 'email', 'order' => 'asc'])) }}">{{ __('Email') }}</a>
                      @endif
                    </th>
                    <th>{{ __('Role') }}</th>
                    <th>
                      @if (request()->get('sort') === 'created_at')
                        @switch (request()->get('order'))
                          @case('asc')
                            <a href="{{ route('users.index', url_filter(['sort' => 'created_at', 'order' => 'desc'])) }}">{{ __('Date Created') }} <i class="fa fa-sort-numeric-down"></i></a>
                            @break

                          @case('desc')
                            <a href="{{ route('users.index', url_filter(['sort' => '', 'order' => ''])) }}">{{ __('Date Created') }} <i class="fa fa-sort-numeric-up"></i></a>
                            @break

                          @default
                            <a href="{{ route('users.index', url_filter(['sort' => 'created_at', 'order' => 'asc'])) }}">{{ __('Date Created') }}</a>
                        @endswitch
                      @else
                        <a href="{{ route('users.index', url_filter(['sort' => 'created_at', 'order' => 'asc'])) }}">{{ __('Date Created') }}</a>
                      @endif
                    </th>
                    <th class="text-center">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($resources as $i => $resource)
                    <tr>
                      <td class="table-select collapse">
                        <div class="custom-control custom-checkbox">
                          <input data-select data-target=".bulk-data" id="checkbox-{{ $resource->id }}" type="checkbox" class="custom-control-input" value="{{ $resource->id }}" name="id[]">
                          <label for="checkbox-{{ $resource->id }}" class="custom-control-label"></label>
                        </div>
                      </td>
                      <td class="w-1 pl-5">
                        @if (user()->id === $resource->id)
                          <div title="{{ __('This is your account') }}"><i class="fe fe-user text-muted"></i></div>
                        @endif
                      </td>
                      <td class="w-1">
                        <div class="d-flex">
                          <span class="avatar" style="background-image: url({{ $resource->photo }})"></span>
                        </div>
                      </td>
                      <td style="min-width: 200px">
                        <a title="{{ __('View details') }}" href="{{ route('users.show', $resource->id) }}">
                          {{ $resource->displayname }}
                        </a>
                      </td>
                      <td>{{ $resource->email }}</td>
                      <td>{{ $resource->displayrole }}</td>
                      <td title="{{ $resource->created_at }}">{{ $resource->created }}</td>
                      <td class="text-center justify-content-center">
                        <a title="{{ __('Edit this user') }}" href="{{ route('users.edit', $resource->id) }}" role="button" class="btn btn-secondary btn-sm"><i class="fe fe-edit-2"></i></a>

                        <button data-modal-toggle type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#delete-single-confirmbox-{{ $resource->id }}" title="{{ __('Move this user to trash') }}">
                          <i class="fe fe-trash-2"></i>
                        </button>
                        @include('Theme::partials.modal', [
                          'dataset' => false,
                          'id' => 'delete-single-confirmbox-'.$resource->id,
                          'icon' => 'fe fe-user-x display-1 icon-border icon-faded d-inline-block',
                          'lead' => __('You are about to deactivate the selected user.'),
                          'text' => 'If you have selected your account and continued, you will be signed out from the app. Are you sure yout want to continue?',
                          'method' => 'DELETE',
                          'action' => route('users.destroy', $resource->id),
                          'button' => __("Deactivate {$resource->firstname}"),
                          'context' => 'warning',
                        ])
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <footer class="card-footer border-0 d-flex justify-content-center">
              @include('Theme::partials.pagination')
            </footer>
          </div>
          <footer class="p-1 pb-5 border-0 d-flex justify-content-center">
            @include('Theme::partials.pagestats')
          </footer>
        @endif

        @empty ($resources->items())
          <div class="p-5">
            @include('Theme::states.empty')
          </div>
        @endempty

      </div>
    </div>
  </div>
@endsection

@push('after:footer')
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
    'include' => 'Theme::fields.export',
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

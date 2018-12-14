@extends("Theme::layouts.admin")

@section('head:title', __('Archived Timesheets'))
@section('page:title', __('Archived Timesheets'))

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
                        <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#delete-confirmbox" title="{{ __('Select timesheets to deactivate') }}">
                          <i class="fe fe-trash"></i>
                        </button>
                      </div>

                      <div class="btn-group ml-3" role="group">
                        @include('Theme::partials.perpage')
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
                    <th colspan="1" class="pl-5">
                      @if (request()->get('sort') === 'name')
                        @switch (request()->get('order'))
                          @case('asc')
                            <a href="{{ route('timesheets.index', url_filter(['sort' => 'name', 'order' => 'desc'])) }}">{{ __('Batch Name') }} <i class="fa fa-sort-alpha-down"></i></a>
                            @break

                          @case('desc')
                            <a href="{{ route('timesheets.index', url_filter(['sort' => '', 'order' => ''])) }}">{{ __('Batch Name') }} <i class="fa fa-sort-alpha-up"></i></a>
                            @break

                          @default
                            <a href="{{ route('timesheets.index', url_filter(['sort' => 'name', 'order' => 'asc'])) }}">{{ __('Batch Name') }}</a>
                        @endswitch
                      @else
                        <a href="{{ route('timesheets.index', url_filter(['sort' => 'name', 'order' => 'asc'])) }}">{{ __('Batch Name') }}</a>
                      @endif
                    </th>
                    <th>{{ __('Uploader') }}</th>
                    <th>
                      @if (request()->get('sort') === 'created_at')
                        @switch (request()->get('order'))
                          @case('asc')
                            <a href="{{ route('timesheets.index', url_filter(['sort' => 'created_at', 'order' => 'desc'])) }}">{{ __('Date Created') }} <i class="fa fa-sort-numeric-down"></i></a>
                            @break

                          @case('desc')
                            <a href="{{ route('timesheets.index', url_filter(['sort' => '', 'order' => ''])) }}">{{ __('Date Created') }} <i class="fa fa-sort-numeric-up"></i></a>
                            @break

                          @default
                            <a href="{{ route('timesheets.index', url_filter(['sort' => 'created_at', 'order' => 'asc'])) }}">{{ __('Date Created') }}</a>
                        @endswitch
                      @else
                        <a href="{{ route('timesheets.index', url_filter(['sort' => 'created_at', 'order' => 'asc'])) }}">{{ __('Date Created') }}</a>
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
                      <td>
                        <a title="{{ __('View details') }}" href="{{ route('timesheets.show', $resource->id) }}">{{ $resource->name }}</a>
                      </td>
                      <td>{{ $resource->user->displayname }}</td>
                      <td title="{{ $resource->created_at }}">{{ $resource->created }}</td>
                      <td class="text-center justify-content-center">
                        <form class="d-inline-block" action="{{ route('timesheets.restore', $resource->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
                          <button class="btn btn-secondary btn-sm" title="{{ __('Restore this timesheet') }}">
                            <i class="mdi mdi-restore"></i>
                          </button>
                        </form>

                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#permadelete-single-confirmbox-{{ $resource->id }}" title="{{ __('Permanently delete this timesheet') }}">
                          <i class="mdi mdi-close"></i>
                        </button>
                        @include('Theme::partials.modal', [
                          'dataset' => false,
                          'id' => 'permadelete-single-confirmbox-'.$resource->id,
                          'icon' => 'mdi mdi-close display-1 icon-border icon-faded d-inline-block',
                          'lead' => __('You are about to permanently delete the selected timesheet.'),
                          'text' => 'This action is irreversable. Are you sure yout want to continue?',
                          'method' => 'DELETE',
                          'action' => route('timesheets.delete', $resource->id),
                          'button' => __("Permanently Delete"),
                          'context' => 'danger',
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
  {{-- Move to Trash --}}
  @include('Theme::partials.modal', [
    'id' => 'delete-confirmbox',
    'icon' => 'fe fe-trash display-1 icon-border icon-faded d-inline-block',
    'lead' => __('You are about to deactivate the selected timesheets.'),
    'text' => 'If you have selected your account and continued, you will be signed out from the app. Are you sure yout want to continue?',
    'method' => 'DELETE',
    'action' => route('timesheets.destroy'),
    'button' => __('Trash Timesheets'),
    'context' => 'warning',
  ])
@endpush

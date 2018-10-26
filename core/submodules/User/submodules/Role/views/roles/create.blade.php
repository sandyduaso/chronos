@extends('Theme::layouts.admin')

@section('head:title', __('Add Role'))
@section('page:title', __('Add Role'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <form class="card" action="{{ route('roles.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="card-body">
            @include('Theme::fields.input', ['name' => 'name', 'attr' => 'data-slugger=[name=code]'])

            @include('Theme::fields.input', ['name' => 'code'])

            @include('Theme::fields.textarea', ['name' => 'description'])
          </div>

          <div class="card-body">
            {{-- @include('Theme::fields.treeview', ['name' => 'roles[]']) --}}
            <div class="btn-group btn-group-toggle mb-3">
              <button type="button" data-tree-toggle="collapse" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-collapse-vertical">&nbsp;</i>{{ __('Collapse') }}</button>
              <button type="button" data-tree-toggle="expand" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-expand-vertical">&nbsp;</i>{{ __('Expand') }}</button>
              <button type="button" data-tree-toggle="check" class="btn btn-sm btn-secondary"><i class="mdi mdi-check-all">&nbsp;</i>{{ __('Check') }}</button>
              <button type="button" data-tree-toggle="uncheck" class="btn btn-sm btn-secondary"><i class="mdi mdi-checkbox-blank-outline">&nbsp;</i>{{ __('Uncheck') }}</button>
            </div>

            <div class="treeview-body">
              <ul data-tree class="list-group">
                @foreach ($repository->permissions() as $group => $permissions)
                  <li data-tree-item class="list-group-item">
                    <div data-tree-header class="d-flex justify-content-between">
                      <div class="custom-control custom-checkbox">
                        <input id="checkbox-{{ $group }}" type="checkbox" class="custom-control-input">
                        <label for="checkbox-{{ $group }}" role="button" class="custom-control-label">
                          <strong>{{ ucfirst($group) }}</strong>
                        </label>
                      </div>
                      <button data-tree-label type="button" class="btn btn-sm btn-secondary">
                        <i class="mdi mdi-chevron-down"></i>
                      </button>
                    </div>
                    <ul data-tree-child class="list-group border-0">
                      @foreach ($permissions as $permission)
                        <li data-tree-item class="list-group-item border-0">
                          <div class="custom-control custom-checkbox">
                            <input data-tree-checkbox {{ in_array($permission->id, (old('permissions') ?? [])) ? 'checked=checked' : null }} id="checkbox-{{ $group }}-{{ $permission->id }}" type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->id }}">
                            <label data-tree-label for="checkbox-{{ $group }}-{{ $permission->id }}" role="button" class="custom-control-label">
                              <strong>{{ $permission->code }}</strong>
                              <em>{{ $permission->description }}</em>
                            </label>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="card-footer border-0 text-right">
            <button type="submit" class="btn btn-primary">{{ __('Add Role') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

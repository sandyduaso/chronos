@extends('Theme::layouts.admin')

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
        <form class="card" action="{{ $action ?? route('categories.store') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="type" value="{{ $repository->type() }}">
          <div class="card-header border-0">
            @section('formcreate:title')
              <h1 class="card-title">{{ __("New Category") }}</h1>
            @show
          </div>
          @section('formcreate:body')
            <div class="card-body">
              <div class="form-group">
                <label for="form-name" class="form-label">{{ __('Name') }}</label>
                <input id="form-name" type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <div class="invalid-feedback">{{ __($errors->first('name')) }}</div>
                @endif
              </div>

              {{-- <div class="form-group">
                <label for="form-alias" class="form-label">{{ __('Alias') }}</label>
                <input id="form-alias" type="text" name="alias" class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}" value="{{ old('alias') }}">
                @if ($errors->has('alias'))
                  <div class="invalid-feedback">{{ __($errors->first('alias')) }}</div>
                @endif
              </div> --}}

              <div class="form-group">
                <label class="form-label">{{ __('Icon') }}</label>
                @include('Theme::fields.selecticons', [
                  'name' => 'icon',
                  'value' => old('icon'),
                  'attr' => 'data-selectpicker data-live-search="true"',
                ])
                @if ($errors->has('icon'))
                  <div class="small text-danger">{{ __($errors->first('icon')) }}</div>
                @endif
              </div>

              <div class="form-group">
                <label for="form-description" class="form-label">{{ __('Description') }}</label>
                <textarea id="form-description" type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                  <div class="invalid-feedback">{{ __($errors->first('description')) }}</div>
                @endif
              </div>
            </div>
          @show
          <div class="card-footer border-0">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
      <div class="col-lg-9">
        <div class="card card-table card-sm">
          <div class="card-header border-x">
            @section('tablelist:title')
              <h1 class="card-title">{{ __('All Categories') }}</h1>
            @show
          </div>
          @section('tablelist:body')
            <div class="table-responsive">
              <table class="table table-sm table-striped">
                <thead>
                  <tr class="text-left">
                    <th colspan="2">{{ __('Name') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($resources as $resource)
                    <tr>
                      <td class="w-1"><i class="{{ $resource->icon }}"></i></td>
                      <td>{{ $resource->name }}</td>
                      <td>{{ $resource->code }}</td>
                      <td></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @show
        </div>
      </div>
    </div>
  </div>
@endsection

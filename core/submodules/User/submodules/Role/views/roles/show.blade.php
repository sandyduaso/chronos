@extends('Theme::layouts.admin')

@section('head:title', $resource->name)
@section('page:title', $resource->name)

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <p>{!! $resource->description !!}</p>

        <p class="form-label">{{ __('Permissions') }}</p>

        <div class="row">
          <div class="col-sm-12 col-lg-4">
            @include('Theme::fields.treeview', [
              'label' => null,
              'actions' => false,
              'readonly' => true,
              'icon' => 'mdi mdi-shield-half-full text-green',
              'items' => $resource->permissions->groupBy('group'),
              'key' => 'code',
              'text' => 'description',
            ])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
